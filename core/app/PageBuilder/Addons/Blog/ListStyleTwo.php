<?php


namespace App\PageBuilder\Addons\Blog;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\SubCategory;
use Modules\Attributes\Entities\Unit;
use Modules\Blog\Entities\Blog;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Entities\Tag;

class ListStyleTwo extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at an admin panel so that user knows about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'news-update/list-01.png';
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Page: Blog List 02');
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

        $blogs = Blog::where('status', 'publish')->pluck('title','id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'blogs',
            'multiple' => true,
            'label' => __('Blogs'),
            'placeholder' =>  __('Select Blogs'),
            'options' => $blogs,
            'value' => $widget_saved_values['blogs'] ?? null,
            'info' => __('you can select item for blogs, if you want to show all blog leave it empty')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show per page, if you leave it empty 15 blogs will be shown per page'),
        ]);
        $output .= Text::get([
            'name' => 'read_more_btn_text',
            'label' => __('Read More Button Text'),
            'value' => $widget_saved_values['read_more_btn_text'] ?? null,
        ]);

        $output .= Select::get([
            'name' => 'sidebar_position',
            'label' => __('Sidebar Position'),
            'options' => [
                'left' => __('Left'),
                'right' => __('Right'),
            ],
            'value' => $widget_saved_values['sidebar_position'] ?? null,
            'info' => __('set sidebar position')
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 60,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 60,
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

        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $sidebar_position = SanitizeInput::esc_html($this->setting_item('sidebar_position'));

        $blog_items = $this->setting_item('blogs');
        $blog_items = sanitizeArray($blog_items) ?? [];

        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $readMoreBtnText = SanitizeInput::esc_html($this->setting_item('read_more_btn_text')) ?? __('Read More');

        $blogs = Blog::query()->with('category')->where(['status' => 'publish']);

        if (!empty($blog_items)) {
            $blogs->whereIn('id', $blog_items);
        }

        $items = !empty($items) ? $items : 15;
        $all_blogs = $blogs->paginate($items);

        // those line of code are only for sidebar filtering
        $all_category = Category::where('status_id', 1)
            ->with('subcategory')
            ->withCount('product')
            ->get();
        $all_subcategory = SubCategory::where('status_id', 1)
            ->get()->groupBy('category_id');
        $all_attributes = ProductAttribute::all();
        $all_tags = Tag::all();
        $all_units = Unit::all();

        $maximum_available_price = Product::query()->with('category')->max('price');
        $min_price = request()->get('pr_min') ?? Product::query()->min('price');
        $max_price = request()->get('pr_max') ?? $maximum_available_price;

        return $this->renderBlade('blog.blog_list_style_two', [
            'padding_top' => $padding_top,
            'padding_bottom' => $padding_bottom,
            'all_blogs' => $all_blogs,
            'readMoreBtnText' => $readMoreBtnText,
            'sidebar_position' => $sidebar_position,
            'all_category' => $all_category,
            'all_subcategory' => $all_subcategory,
            'all_attributes' => $all_attributes,
            'all_tags' => $all_tags,
            'all_units' => $all_units,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'maximum_available_price' => $maximum_available_price
        ]);
    }
}
