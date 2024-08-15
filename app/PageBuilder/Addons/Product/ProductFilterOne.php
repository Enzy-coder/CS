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
use Modules\Product\Entities\Product;

class ProductFilterOne extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Product Filter: 01');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'product/filter-01.png';
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
        $output .= Image::get([
            'name' => 'title_image',
            'label' => __('Title Image'),
            'dimensions' => __('105×23'),
            'value' => $widget_saved_values['title_image'] ?? null,
        ]);
        $output .= '</div>';

        // product
        $output .= '<div class="all-field-wrap">';
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
        $section_title = SanitizeInput::esc_html($this->setting_item('section_title'));
        $title_image = SanitizeInput::esc_html($this->setting_item('title_image'));

        // product
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $product_items = $this->setting_item('product_items') ?? [];

        // padding
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));

        $products = Product::query()->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
            $query->whereNull("vendor_id");
        })->with('category', 'inventory', 'ratings','campaign_product');

        if (!empty($product_items)) {
            $products->whereIn('id', $product_items);
        }

        $products->where(['status_id' => 1]);

        if ($order_by === 'rating') {
            $products = $products->with('ratings')->get();
            $all_products = $products->sortByDesc(function ($products,$key){
                return $products->ratings()->avg('ratings');
            });
        } else {
            $products->orderBy($order_by, $order);
            $all_products =  $products->get();
        }

        if (!empty($items)) {
            $all_products = $all_products->take($items);
        }

        $section_data = [
            'section_title' => $section_title,
            'title_image' => $title_image,
            'all_products' => $all_products,
            'padding_top' => $padding_top,
            'padding_bottom' => $padding_bottom,
        ];

        return $this->renderBlade('product.product_filter_one', $section_data);
    }
}
