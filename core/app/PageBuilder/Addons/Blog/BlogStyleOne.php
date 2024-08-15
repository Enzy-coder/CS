<?php

namespace App\PageBuilder\Addons\Blog;

use App\Blog;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

class BlogStyleOne extends PageBuilderBase
{
    public function addon_title(): array|string|Translator|Application|null
    {
        return __('Blog Style: 01');
    }

    public function preview_image(): string
    {
        return 'blog/blog-style-01.jpg';
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Title'),
            'value' => $widget_saved_values["section_title"] ?? ""
        ]);

        $blogs = Blog::select("title","id")->pluck("title","id")->toArray();

        $output .= NiceSelect::get([
            'name' => 'blogs',
            'multiple' => true,
            'label' => __('Blogs'),
            'placeholder' =>  __('Select Blogs'),
            'options' => $blogs,
            'value' => $widget_saved_values['blogs'] ?? null,
            'info' => __('you can select item for blogs, if you want to show random blog leave it empty')
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
        $section_title = SanitizeInput::esc_html($all_settings['section_title']);
        $blogs_ids = $all_settings["blogs"] ?? [];

        $blogs = Blog::query();
        if (!empty($blogs_ids)){
            $blogs->whereIn("id", $blogs_ids);
        }else{
            $blogs->inRandomOrder()->limit(3);
        }

        $blogs = $blogs->get();

        return $this->renderBlade("blog/style-01", compact("padding_top","padding_bottom","section_title","blogs"));
    }
}