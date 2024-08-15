<?php


namespace App\MenuBuilder\CategoryMenu;

use App\BlogCategory;
use App\MenuBuilder\CategoryMenuBase;
use App\PageBuilder\Helpers\Traits\RenderMegaMenuView;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\SubCategory;
use Modules\Product\Entities\ProductSubCategory;

class StyleTwoCategoryMenu extends CategoryMenuBase
{
    use RenderMegaMenuView;

    function model(): string
    {
        return 'Modules\Attributes\Entities\Category';
    }

    function render($ids,$lang,$subcat_id=null,$title = null): string
    {
        //it will have all html markup for the mega menu frontend
        $sub_ids = explode(',',$subcat_id);
        $output = '';
        if (empty($ids)){
            return $output;
        }


        $mega_menu_items = SubCategory::with("image")->whereIn('id',$sub_ids)->get();

        return $this->renderMegaMenuViews("style_two_category_menu",compact("mega_menu_items","title"));
    }

    function category($id)
    {
        $category = BlogCategory::where(['id' => $id])->first();
        return $category->name ?? __('Uncategorized');
    }

    function route(): string
    {
        //  Implement route() method.
        return 'frontend.blog.single';
    }

    function routeParams()
    {
        //  Implement routeParams() method.
        return ['id'];
    }

    function name()
    {
        //  Implement name() method.
        return __('Category Mega Menus 02');
    }

    function enable()
    {
        //  Implement enable() method.
        return true;
    }

    function query_type()
    {
        //  Implement query_type() method.
        return 'no_lang'; // old_lang|new_lang
    }
    function title_param()
    {
        //  Implement title_param() method.
        return 'title';
    }
    function slug()
    {
        //  Implement name() method.
        return 'blog_page_slug';
    }
}