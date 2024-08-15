<?php

namespace Modules\CountryManage\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\CountryManage\Entities\Country;
use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CountryManage\Http\Requests\StoreCountryManageRequest;
use Modules\CountryManage\Http\Requests\UpdateCountryManageRequest;

class CountryManageController extends Controller
{
    const BASE_URL = 'backend.country.';
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $all_countries = Country::all();
        return view('countrymanage::backend.all-country', compact('all_countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCountryManageRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCountryManageRequest $request): RedirectResponse
    {
        $country = Country::create([
            'name' => $request->sanitize_html('name'),
            'status' => $request->sanitize_html('status'),
        ]);

        return $country->id
            ? back()->with(FlashMsg::create_succeed('Country'))
            : back()->with(FlashMsg::create_failed('Country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCountryManageRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateCountryManageRequest $request): RedirectResponse
    {
        $updated = Country::findOrFail($request->id)->update([
            'name' => $request->sanitize_html('name'),
            'status' => $request->sanitize_html('status'),
        ]);

        return $updated
            ? back()->with(FlashMsg::update_succeed('Country'))
            : back()->with(FlashMsg::update_failed('Country'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $item
     * @return RedirectResponse
     */
    public function destroy(Country $item): RedirectResponse
    {
        return $item->delete()
            ? back()->with(FlashMsg::delete_succeed('Country'))
            : back()->with(FlashMsg::delete_failed('Country'));
    }

    public function bulk_action(Request $request)
    {
        $deleted = Country::whereIn('id', $request->ids)->delete();
        if ($deleted) {
            return 'ok';
        }
    }


    public function import_settings()
    {
        return view('countrymanage::backend.import-country');
    }

    public function update_import_settings(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:150000'
        ]);

        //: work on file mapping
        if ($request->hasFile('csv_file')) {
            $file = $request->csv_file;
            $extenstion = $file->getClientOriginalExtension();
            if ($extenstion == 'csv') {
                //copy file to temp folder

                $old_file = Session::get('import_csv_file_name');
                if (file_exists('assets/uploads/import/' . $old_file)) {
                    @unlink('assets/uploads/import/' . $old_file);
                }
                $file_name_with_ext = $file->getClientOriginalName();

                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));

                $file_tmp_name = $file_name . time() . '.' . $extenstion;
                $file->move('assets/uploads/import', $file_tmp_name);

                $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));
                $csv_data = array_slice($data, 0, 1);

                Session::put('import_csv_file_name', $file_tmp_name);

                return view('countrymanage::backend.import-country', [
                    'import_data' => $csv_data,
                ]);
            }

        }
        FlashMsg::item_update(__('something went wrong try again!'));
        return back();
    }

    public function import_to_database_settings(Request $request)
    {
        $file_tmp_name = Session::get('import_csv_file_name');
        $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));

        $csv_data = current(array_slice($data, 0, 1));
        $csv_data = array_map(function ($item) {
            return trim($item);
        }, $csv_data);

        $imported_countries = 0;
        $x = 0;
        $country = array_search($request->country, $csv_data, true);

        foreach ($data as $index => $item) {
            if($x == 0){
                $x++;
                continue ;
            }
            $find_country = Country::where('name', $item[$country] )->count();

            if ($find_country < 1) {
                $country_data = [
                    'name' => $item[$country] ?? '',
                    'status' => $request->status,
                ];
            }
            if ($find_country < 1) {
                Country::create($country_data);
                $imported_countries++;
            }
        }

        return redirect()->route('admin.country.import.csv.settings')->with([
            'msg' => __('Countries imported successfully'),
            'type' => 'success',
        ]);
    }


}
