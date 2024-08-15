<?php

namespace App\PageBuilder\Addons\Page;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\Unit;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Entities\Tag;

class ShopPage extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     *
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Shop Page: 01');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     *
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'page/shop-01.png';
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     *
     * @since 1.0.0
     * */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        // section
        if (false) {
            $output .= '<div class="all-field-wrap">';
            $output .= '<h6 class="mb-3">'.__('Page Settings').'</h6>';
            $output .= Text::get([
                'name' => 'page_title',
                'label' => __('Page Title'),
                'value' => $widget_saved_values['page_title'] ?? null,
            ]);
            $output .= Select::get([
                'name' => 'item_style',
                'label' => __('Product Item Style'),
                'value' => $widget_saved_values['item_style'] ?? null,
                'options' => [
                    'grid' => __('Grid'),
                    'list' => __('List'),
                ],
                'info' => __('Show product item as'),
            ]);
            $output .= Select::get([
                'name' => 'sidebar_position',
                'label' => __('Sidebar Position'),
                'options' => [
                    'left' => __('Left'),
                    'right' => __('Right'),
                    'hide' => __('Hide'),
                ],
                'value' => $widget_saved_values['sidebar_position'] ?? null,
            ]);
            $output .= '</div>';
        }

        // product
        $output .= '<div class="all-field-wrap">';
        $output .= '<h6 class="mb-3">'.__('Product Section').'</h6>';

        $products = Product::where(['status_id' => 1])
            ->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
                $query->whereNull("vendor_id");
            })->get()->pluck('name', 'id')->toArray();

        $output .= NiceSelect::get([
            'name' => 'product_items',
            'multiple' => true,
            'label' => __('Products'),
            'placeholder' => __('Select Products'),
            'options' => $products,
            'value' => $widget_saved_values['product_items'] ?? null,
            'info' => __('Select particular item(s) to display, if you want to show all product leave it empty'),
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
            'info' => __('set order by'),
        ]);
        $output .= Select::get([
            'name' => 'items_order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Ascending'),
                'desc' => __('Descending'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set product order'),
        ]);
        $output .= Number::get([
            'name' => 'items_count',
            'label' => __('Number of items per page'),
            'value' => $widget_saved_values['items_count'] ?? null,
            'info' => __('Enter how many item you want to show in frontend. If you leave it empty 15 products will be show by default.'),
        ]);
        $output .= '</div>';

        if (false) {
            // selected items
            $output .= '<div class="all-field-wrap">';
            $output .= '<h6 class="mb-3">'.__('Selected Items').'</h6>';
            $output .= Text::get([
                'name' => 'selected_items_name',
                'label' => __('Section Title'),
                'value' => $widget_saved_values['selected_items_name'] ?? null,
            ]);
            $output .= Switcher::get([
                'name' => 'selected_items_display_status',
                'label' => __('Section Display Status'),
                'value' => $widget_saved_values['selected_items_display_status'] ?? null,
            ]);
            $output .= Number::get([
                'name' => 'selected_items_count',
                'label' => __('Number of selected items to show'),
                'value' => $widget_saved_values['selected_items_count'] ?? null,
                'info' => __('Enter how many item you want to show Recently Added section. If you leave it empty 3 products will be show by default.'),
            ]);
            $output .= NiceSelect::get([
                'name' => 'selected_product_items',
                'multiple' => true,
                'label' => __('Products'),
                'placeholder' => __('Selected Products'),
                'options' => $products,
                'value' => $widget_saved_values['selected_product_items'] ?? null,
                'info' => __('Select particular item(s) to display. If you leave it empty most recent items will be shown.'),
            ]);
            $output .= '</div>';

            // featured
            $output .= '<div class="all-field-wrap">';
            $output .= '<h6 class="mb-3">'.__('Selected Items').'</h6>';
            $output .= Switcher::get([
                'name' => 'featured_section_display_status',
                'label' => __('Featured Section Display Status'),
                'value' => $widget_saved_values['featured_section_display_status'] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'featured_section_subtitle',
                'label' => __('Section Subtitle'),
                'value' => $widget_saved_values['featured_section_subtitle'] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'featured_section_title',
                'label' => __('Section Title'),
                'value' => $widget_saved_values['featured_section_title'] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'featured_section_btn_text',
                'label' => __('Section Button Text'),
                'value' => $widget_saved_values['featured_section_btn_text'] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'featured_section_btn_url',
                'label' => __('Section Button URL'),
                'value' => $widget_saved_values['featured_section_btn_url'] ?? null,
            ]);
            $output .= Image::get([
                'name' => 'featured_section_background_image',
                'label' => __('Section Background Image'),
                'value' => $widget_saved_values['featured_section_background_image'] ?? null,
            ]);
            $output .= '</div>';
        }

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     *
     * @since 1.0.0
     * */
    public function frontend_render(): string
    {
        $page_title = SanitizeInput::esc_html($this->setting_item('page_title'));
        $sidebar_position = SanitizeInput::esc_html($this->setting_item('sidebar_position'));
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top') ?? 0);
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom') ?? 0);
        $items_count = request()->count ?? SanitizeInput::esc_html($this->setting_item('items_count'));

        $item_style = request()->s ?? $this->sanitizedText('item_style') ?? '';

        $all_category = Category::where('status_id', 1)->with('subcategory')->withCount('product')->get();
        $all_subcategory = Category::where('status_id', 1)->get()->groupBy('category_id');
        $all_attributes = ProductAttribute::all();
        $all_tags = Tag::all();
        $all_units = Unit::all();

        $maximum_available_price = Product::query()->with('category')->max('price');
        $min_price = request()->pr_min ? request()->pr_min : Product::query()->min('price');
        $max_price = request()->pr_max ? request()->pr_max : $maximum_available_price;

        $page_data = [];

        /* ====================================================
         *              SELECTED PRODUCT SECTION
         * ==================================================== */
        $selected_items_name = $this->sanitizedText('selected_items_name');
        $selected_items_display_status = $this->sanitizedText('selected_items_display_status');
        $selected_items_count = $this->sanitizedText('selected_items_count');
        $selected_product_items = $this->sanitizedText('selected_product_items');

        $selected_products = Product::query()
            ->with('ratings', 'campaign_product', 'inventory')
            ->withAvg('ratings', 'rating')
            ->where('status_id', 1);

        if (! empty($selected_product_items)) {
            $selected_products = $selected_products->whereIn('id', $selected_product_items);
        }

        $selected_products = $selected_products->orderByDesc('created_at')->get();

        if (! empty($selected_items_count)) {
            $selected_products->take($selected_products);
        } else {
            $selected_products = $selected_products->take(3);
        }

        $page_data['selected_items_name'] = $selected_items_name;
        $page_data['selected_items_display_status'] = $selected_items_display_status;
        $page_data['selected_items'] = $selected_products;

        /* ====================================================
         *                  FEATURED SECTION
         * ==================================================== */
        $page_data['featured_section_display_status'] = $this->sanitizedText('featured_section_display_status');
        $page_data['featured_section_subtitle'] = $this->sanitizedText('featured_section_subtitle');
        $page_data['featured_section_title'] = $this->sanitizedText('featured_section_title');
        $page_data['featured_section_btn_text'] = $this->sanitizedText('featured_section_btn_text');
        $page_data['featured_section_btn_url'] = $this->sanitizedText('featured_section_btn_url');
        $page_data['featured_section_background_image'] = $this->sanitizedText('featured_section_background_image');

        /* ====================================================
         *                  PRODUCT SECTION
         * ==================================================== */
        $sort_by = request()->sort ?? $this->sanitizedText('order_by') ?? 'default';
        $display_item_count = request()->count ?? get_static_option('default_item_count') ?? 15;
        $style = isset(request()->s) && request()->s == 'list' ? 'list' : 'grid';

        // if not product search
        if (! (request()->q || request()->cat || request()->subcat || request()->unt || request()->attr || request()->rt || request()->t)) {
            $all_products = getProductByParams([
                'product_items' => $this->setting_item('product_items') ?? [],
                'items_order' => $this->sanitizedText('items_order'),
                'items_count' => $items_count,
                'sort_by' => $sort_by,
            ]);
        } else {
            $all_products = Product::query()
                ->with('inventory', 'campaign', 'category', 'ratings')
                ->withAvg('ratings', 'rating')
                ->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
                    $query->whereNull("vendor_id");
                })
                ->where('status_id', 1);

            // search title
            if (request()->q) {
                $query = request()->q;
                $all_products->where('name', 'LIKE', "%$query%");
            }

            // category search
            if (request()->cat) {
                $all_products->where('category_id', request()->cat);
            }

            // subcategory search
            if (request()->subcat) {
                $all_products->whereJsonContains('sub_category_id', request()->subcat);
            }

            // unit search
            if (request()->unt) {
                $all_products->where('uom', request()->unt);
            }

            if ($min_price && $min_price > 0) {
                $all_products->where('price', '>=', $min_price);
            }

            if ($max_price) {
                $all_products->where('price', '<=', $max_price);
            }

            // filter by attribute
            if (request()->attr) {
                $filter_attributes = json_decode(request()->attr, true);
                if (is_array($filter_attributes)) {
                    foreach ($filter_attributes as $attr) {
                        if (isset($attr['id']) && isset($attr['attribute'])) {
                            $all_products->whereJsonContains('attributes->'.$attr['id'], $attr['attribute']);
                        }
                    }
                }
            }

            // filter by rating
            if (request()->rt) {
                $rating = request()->rt;
                $all_products->whereHas('rating', function ($query) use ($rating) {
                    $query->where('rating', $rating);
                });
            }

            // filter by tag
            if (request()->t) {
                $tag = request()->t;
                $all_products->whereHas('tags', function ($query) use ($tag) {
                    $query->where('tag', $tag);
                });
            }

            if ($sort_by == 'popularity') {
                $all_products->orderBy('sold_count', 'DESC');
            } elseif ($sort_by == 'latest') {
                $all_products->orderBy('created_at', 'DESC');
            } elseif ($sort_by == 'price_low') {
                $all_products->orderBy('price', 'ASC');
            } elseif ($sort_by == 'price_high') {
                $all_products->orderBy('price', 'DESC');
            }

            $all_products = productSort($all_products, $sort_by)->paginate($display_item_count);
        }

        if ($all_products->count() <= $display_item_count) {
            request()->page = 1;
        }

        $page_data['all_category'] = $all_category;
        $page_data['all_subcategory'] = $all_subcategory;
        $page_data['all_attributes'] = $all_attributes;
        $page_data['maximum_available_price'] = $maximum_available_price;
        $page_data['all_tags'] = $all_tags;
        $page_data['all_units'] = $all_units;

        $page_data['item_style'] = $item_style;
        $page_data['page_title'] = $page_title;
        $page_data['sidebar_position'] = $sidebar_position;
        $page_data['all_products'] = $all_products;
        $page_data['min_price'] = $min_price;
        $page_data['max_price'] = $max_price;
        $page_data['display_item_count'] = $display_item_count;
        $page_data['sort_by'] = $sort_by;
        $page_data['padding_top'] = $padding_top;
        $page_data['padding_bottom'] = $padding_bottom;

        return $this->renderBlade('page.shop_page', $page_data);
    }
}
