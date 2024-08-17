<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Continent;
use Illuminate\Support\Facades\Storage;
use DB;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;


class ContinentController extends Controller
{
    public function index()
    {
        $all_continents = Continent::all();
        return view('admin.continents.index', compact('all_continents'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'header_image' => 'nullable|image|max:2048',
        ]);

        $continent = new Continent();
        $continent->name = $request->name;
        $continent->slug = $request->slug;
        $continent->description = $request->description;
        $continent->status = $request->status;

        if ($request->hasFile('header_image')) {
            $continent->header_image = $request->file('header_image')->store('uploads/continents','public');
        }

        $continent->save();

        return redirect()->back()->with(['msg' => __('New Continent Added Successfully'), 'type' => 'success']);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'header_image' => 'nullable|image|max:2048',
        ]);

        $continent = Continent::findOrFail($request->id);
        $continent->name = $request->name;
        $continent->slug = $request->slug;
        $continent->description = $request->description;
        $continent->status = $request->status;
        if ($request->hasFile('header_image')) {
            if ($continent->header_image) {
                Storage::delete('public/' . $continent->header_image);
            }
        
            // Store the new image in public/assets/uploads
            $continent->header_image = $request->file('header_image')->store('uploads/continents', 'public');
        }

        $continent->save();

        return redirect()->back()->with(['msg' => __('Continent Updated Successfully'), 'type' => 'success']);
    }

    public function delete($id)
    {
        $continent = Continent::findOrFail($id);

        // Delete the header image if exists
        if ($continent->header_image) {
            Storage::delete($continent->header_image);
        }

        $continent->delete();

        return redirect()->back()->with(['msg' => __('Continent Deleted Successfully'), 'type' => 'danger']);
    }

    public function bulkAction(Request $request)
    {
        $this->validate($request, [
            'ids' => 'required|array',
        ]);

        foreach ($request->ids as $id) {
            $continent = Continent::findOrFail($id);

            // Delete the header image if exists
            if ($continent->header_image) {
                Storage::delete($continent->header_image);
            }

            $continent->delete();
        }

        return redirect()->back()->with(['msg' =>   __('Bulk Action Completed Successfully'), 'type' => 'success']);
    }
    public function culture($continent){
        $default_item_count = get_static_option('default_item_count');
        try{
            $continent = Continent::whereSlug($continent)->first();
            $countries = DB::table('countries')->where('continent_id',$continent->id)
            ->paginate(35);
            $country_ids = DB::table('countries')
                ->where('continent_id', $continent->id)
                ->pluck('id')
                ->toArray();
        }catch(\Exception $e){
            $continent = null;
            $countries = [];
            $country_ids = [];
        }
        $all_products = Product::where('status_id', 1)
            ->with(['campaign_product','campaign_sold_product','inventory'])
            ->whereIn('country_id', $country_ids)
            ->orderBy('id', 'desc')
            ->paginate($default_item_count);
        return view('admin.continents.countries')->with([
            'all_products' => $all_products,
            'continent' => $continent,
            'countries' => $countries,
        ]);
    }
    public function countriesCategories($id){
        $default_item_count = get_static_option('default_item_count');
        $country = DB::table('countries')->whereId($id)->first();
        $all_products = Product::where('status_id', 1)
            ->with(['campaign_product','campaign_sold_product','inventory'])
            ->where('country_id', $country->id)
            ->orderBy('id', 'desc')
            ->paginate($default_item_count);
        $product_categories = ProductCategory::whereCountryId($id)->with('category.image')->groupby('category_id')->get();    
        return view('admin.continents.country-categories')->with([
            'all_products' => $all_products,
            'country' => $country,
            'product_categories' => $product_categories,
        ]);
    }
}
