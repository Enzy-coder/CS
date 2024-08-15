<?php


namespace App\PageBuilder\Addons\Header;


use App\Blog;
use App\CategoryMenu;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use App\Product\ProductCategory;
use Modules\Campaign\Entities\CampaignProduct;
use Modules\Product\Entities\Product;

class HeaderSliderSix extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'header/06.png';
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Header Slider: 06');
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     * @since 1.0.0
     * */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();
        $campaignProducts = CampaignProduct::get("product_id")->pluck("product_id");
        $products = Product::whereIn("id", $campaignProducts)->get(["id", "name"])->pluck("name","id");

        $output .= "<p>". __("Hare is all campaigns products in this select box") ."</p>";
        $output .= NiceSelect::get([
            'name' => 'products',
            'multiple' => true,
            'label' => __('Product'),
            'placeholder' =>  __('Select Product'),
            'options' => $products,
            'value' => $widget_saved_values['products'] ?? null,
            'info' => __('you can select products, if you want to show all product leave it empty we will show 10 latest product')
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     * @since 1.0.0
     * */
    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        $product_ids = $all_settings['products'] ?? [];

        $products = Product::query();

        $products->withCount("inventoryDetail","ratings");
        $products->with("campaign_sold_product","uom","campaign_product","inventory", "badge","taxOptions:tax_class_options.id,country_id,state_id,city_id,rate","vendorAddress:vendor_addresses.id,country_id,state_id,city_id");
        $products->withAvg('ratings','rating');

        $products->when(!empty($product_ids), function ($query) use ($product_ids){
            $query->whereIn("id", $product_ids);
        })->when(empty($prd_ids), function ($query){
            $query->limit(10);
        });
        // call a function for campaign this function will add condition to this table
        $products = productCampaignCondition($products);

        $products = $this->product_order_item_query($products, $all_settings);

        return $this->renderBlade("header.header_slider_six", compact("products"));
    }
}