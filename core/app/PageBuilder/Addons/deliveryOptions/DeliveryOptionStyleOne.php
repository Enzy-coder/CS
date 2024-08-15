<?php

namespace App\PageBuilder\Addons\deliveryOptions;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Attributes\Entities\DeliveryOption;

class DeliveryOptionStyleOne extends PageBuilderBase
{

    public function preview_image(): string
    {
        return 'header/05.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $deliveryOptions = DeliveryOption::select("id","title")->pluck("title","id")->toArray();

        $output .= NiceSelect::get([
            'name' => 'delivery_options',
            'multiple' => true,
            'label' => __('Delivery Option'),
            'placeholder' =>  __('Select Delivery Option'),
            'options' => $deliveryOptions,
            'value' => $widget_saved_values['delivery_options'] ?? null,
            'info' => __('you can select item for Delivery Option, if you leave it empty then we will show 4 item')
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $all_settings = $this->get_settings();

        $selectedDeliveryOptions = $all_settings["delivery_options"] ?? [];
        $deliveryOptions = DeliveryOption::query();
        empty($selectedDeliveryOptions) ?
            $deliveryOptions->limit(4)
            :
            $deliveryOptions->whereIn("id", $selectedDeliveryOptions)
        ;

        $deliveryOptions = $deliveryOptions->get();

        return $this->renderBlade("delivery-option/style-01", compact("deliveryOptions"));
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __("Delivery Option: 01");
    }
}