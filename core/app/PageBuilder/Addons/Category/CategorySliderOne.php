<?php


namespace App\PageBuilder\Addons\Category;


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
use Modules\Attributes\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;

class CategorySliderOne extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Category Slider: 01');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'category/01.jpg';
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

        $categories = Category::select('id', 'name')->get()->pluck('name', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'categories',
            'multiple' => true,
            'label' => __('Categories'),
            'placeholder' =>  __('Select Categories'),
            'options' => $categories,
            'value' => $widget_saved_values['categories'] ?? null,
            'info' => __('You can select categories that you want to display. If you want to show all category leave it empty')
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
        $selected_categories = $this->setting_item('categories');

        if (empty($selected_categories)) {
            $categories = Category::with('image')->get();
        } else {
            $categories = Category::with('image')->whereIn('id', $selected_categories)->get();
        }

        $section_data = [
            'categories' => $categories,
            'padding_top' => SanitizeInput::esc_html($this->setting_item('padding_top')),
            'padding_bottom' => SanitizeInput::esc_html($this->setting_item('padding_bottom')),
        ];

        return $this->renderBlade('category.category_slider_one', $section_data);
    }
}
