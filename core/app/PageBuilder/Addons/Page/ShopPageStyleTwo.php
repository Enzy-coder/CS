<?php


namespace App\PageBuilder\Addons\Page;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Fields\TimePicker;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use Modules\Attributes\Entities\Brand;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\Color;
use Modules\Attributes\Entities\Size;
use Modules\Attributes\Entities\SubCategory;
use Modules\Attributes\Entities\Unit;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\ProductSubCategory;
use Modules\Product\Entities\ProductUnit;
use Modules\Product\Entities\Tag;

class ShopPageStyleTwo extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Shop Page Style: 02');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'page/shop-02.png';
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

        // product
        $output .= '<div class="all-field-wrap">';

        $output .= Text::get([
            'name' => 'page_title',
            'label' => __('Page Title'),
            'value' => $widget_saved_values['page_title'] ?? null,
        ]);
        $output .= '<h6 class="mb-3">'.__('Product Section').'</h6>';
        $products = Product::where(['status_id' => 1])->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
            $query->whereNull("vendor_id");
        })->get()->pluck('title', 'id')->toArray();
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
            'name' => 'items_order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Ascending'),
                'desc' => __('Descending'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set product order')
        ]);

        $output .= Number::get([
            'name' => 'items_count',
            'label' => __('Number of items per page'),
            'value' => $widget_saved_values['items_count'] ?? null,
            'info' => __('Enter how many item you want to show in frontend. If you leave it empty 15 products will be show by default.'),
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
        $page_title = SanitizeInput::esc_html($this->setting_item('page_title'));
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $items_count = request()->count ?? SanitizeInput::esc_html($this->setting_item('items_count'));

        $page_name = $page_post->name ?? 'Product';
        $display_item_count = request()->get('count') ?? 15;
        $all_category = Category::where('status_id', '1')->with('subcategory','subcategory.childcategory')->withCount('product')->get();
        $all_attributes = ProductAttribute::all();
        $all_tags = [];
        $all_units = Unit::all();
        $all_colors = Color::whereHas("product")->get();
        $all_sizes = Size::whereHas("product")->get();
        $all_brands = Brand::whereHas("product")->get();

        $maximum_available_price = Product::query()->max('price');


        $min_price = request()->get('pr_min') ?? Product::query()->min('sale_price');
        $max_price = request()->get('pr_max') ?? $maximum_available_price;

        $item_style = request()->get('s') ?? 'grid';
        $sort_by = request()->get('sort');

        $request = request();
        if(!empty($vendor)){
            $request->vendor_username = $vendor->username;
        }

        /* ====================================================
         *              SELECTED PRODUCT SECTION
         * ==================================================== */
        $selected_items_name = $this->sanitizedText('selected_items_name');
        $selected_items_display_status = $this->sanitizedText('selected_items_display_status');
        $selected_items_count = $this->sanitizedText('selected_items_count');
        $selected_product_items = $this->sanitizedText('selected_product_items');

        $selected_products = Product::query()
                                ->with('ratings', 'campaign_sold_product','campaign_product')
                                ->withAvg('ratings', 'rating')
                                ->withSum("taxOptions", "rate")
                                ->where('status_id', 1);

        if (!empty($selected_product_items)) {
            $selected_products = $selected_products->whereIn('id', $selected_product_items);
        }

        $selected_products = $selected_products->orderBy('created_at', 'DESC')->get();

        if (!empty($selected_items_count)) {
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
        if (!(request()->q || request()->cat || request()->subcat || request()->unt || request()->attr || request()->rt || request()->t)) {
            $all_products = getProductByParams([
                'product_items' => $this->setting_item('product_items') ?? [],
                'items_order' => $this->sanitizedText('items_order'),
                'items_count' => $items_count,
                'sort_by' => $sort_by,
            ]);
        } else {
            $all_products = Product::query()
                ->with('inventory', 'campaign', 'category', 'rating')
                ->withAvg('rating', 'rating')
                ->withSum("taxOptions", "rate")
                ->where('status', 'publish')->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
                    $query->whereNull("vendor_id");
                });
            // search title
            if (request()->q) {
                $query = request()->q;
                $all_products->where('title', 'LIKE', "%$query%");
            }

            // call a function for campaign this function will add condition to this table
            $all_products = productCampaignCondition($all_products);

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
                            $all_products->whereJsonContains('attributes->' . $attr['id'], $attr['attribute']);
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
            } else if ($sort_by == 'latest') {
                $all_products->orderBy('created_at', 'DESC');
            } else if ($sort_by == 'price_low') {
                $all_products->orderBy('price', 'ASC');
            } else if ($sort_by == 'price_high') {
                $all_products->orderBy('price', 'DESC');
            }

            $all_products = productSort($all_products, $sort_by)->paginate($display_item_count);
        }

        if ($all_products->count() <= $display_item_count) {
            request()->page = 1;
        }

        $page_data['all_category'] = $all_category;
//        $page_data['all_subcategory'] = $all_subcategory;
        $page_data['all_attributes'] = $all_attributes;
        $page_data['maximum_available_price'] = $maximum_available_price;
        $page_data['all_tags'] = $all_tags;
        $page_data['all_units'] = $all_units;

        $page_data['item_style'] = $item_style;
        $page_data['page_title'] = $page_title;
        $page_data['all_products'] = $all_products;
        $page_data['min_price'] = $min_price;
        $page_data['max_price'] = $max_price;
        $page_data['display_item_count'] = $display_item_count;
        $page_data['sort_by'] = $sort_by;
        $page_data['padding_top'] = $padding_top;
        $page_data['padding_bottom'] = $padding_bottom;

        return $this->renderBlade('page.full_shop_page', $page_data);
    }
}
