<?php

namespace App\PageBuilder\Addons\Campaign;

use App\AdminShopManage;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Campaign\Entities\Campaign;

class CampaignStyleTwo extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'campaign/campaign-style-two.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $campaigns = Campaign::select('id', 'title')->where('status', 'publish')
            ->whereNull('vendor_id')
            ->latest('id')
            ->pluck('title', 'id')->toArray();

        $output .= Select::get([
            'name' => 'campaign',
            'label' => __('Select Campaign'),
            'placeholder' => __('Select Campaign'),
            'options' => $campaigns,
            'value' => $widget_saved_values['campaign'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        $section_title = SanitizeInput::esc_html($all_settings['section_title'] ?? '');
        $selectedCampaign = $all_settings['campaign'] ?? null;
        $date = now();

        $campaign = Campaign::with(['product' => function ($query) use ($date) {
            $query->withCount('inventoryDetail', 'ratings');
            $query->with(['campaign_sold_product', 'inventory', 'campaign_product' => function ($campaignProduct) use ($date) {
                $campaignProduct->whereDate('end_date', '>=', $date)->whereDate('start_date', '<=', $date);
            }, 'taxOptions:tax_class_options.id,country_id,state_id,city_id,rate', 'vendorAddress:vendor_addresses.id,country_id,state_id,city_id']);
            $query->withAvg('ratings', 'rating');
            // this line of code will return sum of tax rate for example I have 2 tax one is 5 percent another one is 10 percent then this will return 15 percent
            $query->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
                $query->whereNull("vendor_id");
            })->withSum('taxOptions', 'rate');

            return $query;
        }])->when(! empty($selectedCampaign), function ($query) use ($selectedCampaign) {
            $query->where('id', $selectedCampaign);
        })->first();

        if($campaign){
            $campaign->product = $campaign->product->transform(function ($item) {
                if (! empty($item->vendor_id) && get_static_option('calculate_tax_based_on') == 'vendor_shop_address') {
                    $vendorAddress = $item->vendorAddress;
                    $item = tax_options_sum_rate($item, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
                } elseif (empty($item->vendor_id) && get_static_option('calculate_tax_based_on') == 'vendor_shop_address') {
                    $vendorAddress = AdminShopManage::select('id', 'country_id', 'state_id', 'city as city_id')->first();

                    $item = tax_options_sum_rate($item, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
                }

                return $item;
            });
        }

        return $this->renderBlade('campaign/campaign-style-two', compact('campaign', 'section_title'));
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __('Campaign Style: 02');
    }
}
