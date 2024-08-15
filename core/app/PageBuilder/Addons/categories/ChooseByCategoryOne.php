<?php

namespace App\PageBuilder\Addons\categories;

use App\Blog;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Attributes\Entities\Category;

class ChooseByCategoryOne extends PageBuilderBase
{

    public function preview_image(): string
    {
        return "category/ChooseByCategoryOne.png";
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        // add padding option
        $categories = Category::where('status_id',1)
            ->pluck('name','id')->toArray();

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Section Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
        ]);

        $output .= NiceSelect::get([
            'name' => 'categories',
            'multiple' => true,
            'label' => __('Categories'),
            'placeholder' =>  __('Select Blogs'),
            'options' => $categories,
            'value' => $widget_saved_values['blogs'] ?? null,
            'info' => __('you can select item for categories, if you want to show all category leave it empty')
        ]);

        $output .= Text::get([
            'name' => 'limit',
            'label' => __('Limit of category'),
            'value' => $widget_saved_values['limit'] ?? null,
            'info' => __("You can give input of category limit and if you not then system will take latest 8 items from categories")
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }


    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        $all_settings = $this->get_settings();
        $categories = $all_settings['categories'] ?? [];
        $section_title = SanitizeInput::esc_html($all_settings["section_title"]);
        $limit = SanitizeInput::esc_html($all_settings["limit"] ?? 8);

        $categories = Category::with("image")->when(!empty($categories), function ($categoryQuery) use ($categories){
            $categoryQuery->whereIn("id", $categories);
        })->limit($limit)->get();

        return $this->renderBlade("category/choose-category-one", [
            "categories" => $categories,
            "section_title" => $section_title,
       ]);
    }


    /**
     * @inheritDoc
     */
    public function addon_title()
    {
        return __("Choose By Category");
    }
}