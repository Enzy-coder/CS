<?php

namespace App\PageBuilder\Addons\products;

use App\AdminShopManage;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Attributes\Entities\Category;
use Modules\Product\Entities\Product;

class ProductStyleFor extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'product/right-style-04.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $categories = Category::select("id","name")->pluck("name", "id")->toArray();

        $output .= Select::get([
            'name' => 'category_one',
            'label' => __('Select Category'),
            'placeholder' =>  __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['category_one'] ?? null
        ]);

        $output .= Select::get([
            'name' => 'category_two',
            'label' => __('Select Category'),
            'placeholder' =>  __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['category_two'] ?? null
        ]);

        $output .= Select::get([
            'name' => 'category_three',
            'label' => __('Select Category'),
            'placeholder' =>  __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['category_three'] ?? null
        ]);

        $output .= Number::get([
            'name' => 'item_count',
            'label' => __('Category Product Limit'),
            'value' => $widget_saved_values['item_count'] ?? null,
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
        $category_one = SanitizeInput::esc_html($all_settings['category_one']);
        $category_two = SanitizeInput::esc_html($all_settings['category_two']);
        $category_three = SanitizeInput::esc_html($all_settings['category_three']);
        $item_count = SanitizeInput::esc_html($all_settings['item_count']);
        $categories = Category::query();
        $categories = $categories->whereIn("id",[$category_one,$category_two,$category_three]);

        $categories = $categories->with(["product" => function ($query) use($item_count) {
            $query->withCount("inventoryDetail","ratings");
            $query->when(get_static_option('vendor_enable', 'on') != 'on', function ($subQuey){
                $subQuey->whereNull("vendor_id");
            })->with(["campaign_sold_product","uom","campaign_product" => function ($query){
                $query = productCampaignConditionWith($query);
            },"inventory", "badge","taxOptions:tax_class_options.id,country_id,state_id,city_id,rate","vendorAddress:vendor_addresses.id,country_id,state_id,city_id"]);
            $query->withAvg('ratings','rating');
            // this line of code will return a sum of tax rate, for example,
            //I have 2 tax one is 5 percent, another one is 10 percent then this will return 15 percent
            $query->withSum("taxOptions", "rate");
            // call a function for campaign this function will add condition to this table
            return $query;
        }])->get();

        $categories = $categories->transform(function ($category){
            $category->product = $category->product->transform(function ($item){
                $item = tax_options_sum_rate($item);

                if(!empty($item->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address') {
                    $vendorAddress = $item->vendorAddress;
                    $item = tax_options_sum_rate($item, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
                }elseif(empty($item->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address'){
                    $vendorAddress = AdminShopManage::select("id","country_id", "state_id","city as city_id")->first();
                    $item = tax_options_sum_rate($item, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
                }

                return $item;
            });

            return $category;
        });

        return $this->renderBlade("product/right-style-04", compact("padding_top","padding_bottom","item_count","categories","category_one","category_two","category_three"));
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __("Right side product: 04");
    }
}