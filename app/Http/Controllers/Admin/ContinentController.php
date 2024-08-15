<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Continent;
use Illuminate\Support\Facades\Storage;

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
            'description' => 'nullable|string',
            'status' => 'required|string',
            'header_image' => 'nullable|image|max:2048',
        ]);

        $continent = new Continent();
        $continent->name = $request->name;
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
            'description' => 'nullable|string',
            'status' => 'required|string',
            'header_image' => 'nullable|image|max:2048',
        ]);

        $continent = Continent::findOrFail($request->id);
        $continent->name = $request->name;
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

        return redirect()->back()->with(['msg' => __('Bulk Action Completed Successfully'), 'type' => 'success']);
    }
}
