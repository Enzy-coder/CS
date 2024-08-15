<?php

namespace App\PageBuilder\Addons\shop;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Attributes\Entities\DeliveryOption;
use Modules\Campaign\Entities\Campaign;
use Modules\Vendor\Entities\Vendor;

class BestSellingShop extends PageBuilderBase
{

    public function preview_image(): string
    {
        return 'shop/best-selling-shop.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $vendors = Vendor::select("id","business_name")
            ->orderByDesc("vendors.id")->get()->pluck("business_name","id");

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Section Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
        ]);

        $output .= NiceSelect::get([
            'name' => 'vendors',
            'multiple' => true,
            'label' => __('Select Vendor'),
            'placeholder' =>  __('Select Vendor'),
            'options' => $vendors,
            'value' => $widget_saved_values['vendors'] ?? null,
            'info' => __("You can select vendors, if you want to default system then leave it empty. ")
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        $section_title = SanitizeInput::esc_html($all_settings['section_title'] ?? "");
        $selectedVendor = $all_settings["vendors"] ?? [];

        $vendors = Vendor::with("logo","cover_photo")
            ->withAvg("vendorProductRating","rating")
            ->withCount("orderItems","vendorProductRating")
            ->when(!empty($selectedVendor), function ($vendorQuery) use ($selectedVendor){
                $vendorQuery->whereIn("id", $selectedVendor);
            })
            ->when(empty($selectedVendor), function ($vendorQuery) use ($selectedVendor){
                $vendorQuery->limit(6);
            })
            ->whereHas("orderItems")
            ->orderByDesc("order_items_count")->get();

        return $this->renderBlade("shop/best-selling-shop", compact("vendors","section_title"));
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __("Best selling shop: 01");
    }
}