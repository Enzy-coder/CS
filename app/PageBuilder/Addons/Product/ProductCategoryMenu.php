<?php

namespace App\PageBuilder\Addons\Product;

use App\CategoryMenu;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Services\ProductRenderServices;

class ProductCategoryMenu extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Product with category menu: 02');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'slider/category-filter-02.png';
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
        $output .= Text::get([
            'name' => 'category_header_title',
            'label' => __('Category Header Title'),
            'value' => $widget_saved_values['category_header_title'] ?? null,
        ]);

        $output .= Select::get([
            'name' => 'category_menu',
            'label' => __('Select Category Menu'),
            'placeholder' => __('Select Category'),
            'options' => CategoryMenu::get()->pluck("title","id"),
            'value' =>   $widget_saved_values['category_menu'] ?? []
        ]);

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all products'),
        ]);


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

        $items = SanitizeInput::esc_html($settings['items']) ?? null;
        $category_header_title = SanitizeInput::esc_html($this->setting_item('category_header_title'));
        $category_menu = $this->setting_item('category_menu') ?? [];
        $all_products = ProductRenderServices::new_products($items);

        // padding
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));

        $section_data = [
            'category_header_title' => $category_header_title,
            'category' => $category_menu,
            'all_products' => $all_products,
            'padding_top' => $padding_top,
            'padding_bottom' => $padding_bottom,
            'items' => $items,
        ];

        return $this->renderBlade('product.product_category_menu', $section_data);
    }
}