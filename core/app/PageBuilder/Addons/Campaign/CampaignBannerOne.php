<?php

namespace App\PageBuilder\Addons\Campaign;

use App\AdminShopManage;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Attributes\Entities\DeliveryOption;
use Modules\Campaign\Entities\Campaign;

class CampaignBannerOne extends PageBuilderBase
{

    public function preview_image(): string
    {
        return 'campaign/campaign-banner-one.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $campaigns = Campaign::select("id","title")->pluck("title","id")->toArray();

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Section Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
        ]);

        $output .= Select::get([
            'name' => 'campaign',
            'label' => __('Select Campaign'),
            'placeholder' =>  __('Select Campaign'),
            'options' => $campaigns,
            'value' => $widget_saved_values['campaign'] ?? null
        ]);

        $output .= $this->paddings($widget_saved_values);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);
        $section_title = SanitizeInput::esc_html($all_settings['section_title'] ?? "");
        $selectedCampaign = $all_settings["campaign"] ?? null;

        $campaign = Campaign::with(["product" => function ($query){
            $query->withCount("inventoryDetail","ratings");
            $query->with("campaign_sold_product","campaign_product");
            $query->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
                $query->whereNull("vendor_id");
            })->withAvg('ratings','rating');
        }])->when(!empty($selectedCampaign), function ($query) use ($selectedCampaign) {
            $query->where('id', $selectedCampaign);
        })->first();

        $campaign->product = $campaign->product->transform(function ($item) {
            if(!empty($item->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address') {
                $vendorAddress = $item->vendorAddress;
                $item = tax_options_sum_rate($item, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
            }elseif(empty($item->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address'){
                $vendorAddress = AdminShopManage::select("id","country_id", "state_id","city as city_id")->first();

                $item = tax_options_sum_rate($item, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
            }

            return $item;
        });

        return $this->renderBlade("campaign/campaign-style-one", compact("campaign","section_title","padding_bottom", "padding_top"));
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __("Left Side Campaign: 01");
    }
}