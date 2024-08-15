<?php


namespace App\PageBuilder\Addons\Product;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Fields\TimePicker;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Services\ProductRenderServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Product\Entities\Product;

class PopularProductStyleTwo extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title(): array|string|Translator|Application|null
    {
        return __('Popular product: 02');
    }

    /**
     * preview_image
     * this method must have to implement by all widgets to show a preview image at an admin panel so that the user knows about the design which he wants to use
     * @since 1.0.0
     * */
    public function preview_image(): string
    {
        return 'product/popular_product.png';
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

        // section
        $output .= '<div class="all-field-wrap">';
        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Section Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
        ]);

        $products = Product::where(['status_id' => 1])->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
            $query->whereNull("vendor_id");
        })->get()->pluck('name', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'product_items',
            'multiple' => true,
            'label' => __('Products'),
            'placeholder' =>  __('Select Products'),
            'options' => $products,
            'value' => $widget_saved_values['product_items'] ?? null,
            'info' => __('Select particular item(s) to display, if you want to show all product leave it empty')
        ]);
        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
                'sale_price' => __('Price'),
                'sales' => __('Sales'),
                'rating' => __('Ratings'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Ascending'),
                'desc' => __('Descending'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set product order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all products'),
        ]);
        $output .= '</div>';

        // padding
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 90,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 200,
            'max' => 500,
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
        $settings = $this->get_settings();
        $section_title = SanitizeInput::esc_html($settings['section_title'] ?? "");
        $padding_top = SanitizeInput::esc_html($settings['padding_top'] ?? "");
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom'] ?? "");
        $all_products = ProductRenderServices::frontend($settings,false);
        $section_data = [
            'section_title' => $section_title,
            'all_products' => $all_products,
            'padding_top' => $padding_top,
            'padding_bottom' => $padding_bottom,
        ];

        return $this->renderBlade('product.popular_product_two', $section_data);
    }
}
