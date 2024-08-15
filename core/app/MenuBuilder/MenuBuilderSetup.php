<?php


namespace App\MenuBuilder;


class MenuBuilderSetup extends MenuBuilderBase
{

    public function  static_pages_list()
    {
        //  Implement static_pages_list() method.
        return [];
    }

    function register_dynamic_menus()
    {
        //  Implement register_dynamic_menus() method.
        return [

            'pages' => [
                'model' => 'App\Page',
                'name' => 'pages_page_name',
                'route' => 'frontend.dynamic.page',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'no_lang', //old_lang|new_lang
                'status_column' => 'status',
                'status_value' => 'publish'
            ],
            'blog' => [
                'model' => 'App\Blog',
                'name' => 'blog_page_name',
                'route' => 'frontend.blog.single',
                'route_params' => ['slug'],
                'title_param' => 'title',
                'query' => 'no_lang', //old_lang|new_lang|no_lang
                'status_column' => 'status',
                'status_value' => 'publish'
            ],
            'prodcut' => [
                'model' => 'Modules\Product\Entities\Product',
                'name' => 'product_page_name',
                'route' => 'frontend.products.single',
                'route_params' => ['slug'],
                'title_param' => 'name',
                'query' => 'no_lang', //old_lang|new_lang|no_lang,
                'status_column' => 'status_id',
                'status_value' => 1
            ],
        ];
    }

    function category_menu_register_dynamic_menus()
    {
        //  Implement register_dynamic_menus() method.
        return [
            'product_category' => [
                'menu_type' => 'category_menu',
                'model' => 'App\Product\ProductCategory',
                'menu_name' => __('Product Categories'),
                'route' => 'frontend.products.category',
                'route_params' => ['id','title'],
                'title_param' => 'title',
                'query' => 'no_lang' //old_lang|new_lang|no_lang
            ],
        ];
    }

}