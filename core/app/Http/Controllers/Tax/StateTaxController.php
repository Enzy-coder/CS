<?php

namespace Modules\CountryManage\Http\Controllers\Tax;

use Modules\CountryManage\Entities\Country;
use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\TaxModule\Entities\StateTax;

class StateTaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:state-tax-list|state-tax-create|state-tax-edit|state-tax-delete', ['only', ['index']]);
        $this->middleware('permission:state-tax-create', ['only', ['store']]);
        $this->middleware('permission:state-tax-edit', ['only', ['update']]);
        $this->middleware('permission:state-tax-delete', ['only', ['destroy', 'bulk_action']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_country = Country::where('status', 'publish')->get();
        $all_state_tax = StateTax::with('state')->get();

        return view('backend.tax.state-tax', compact('all_state_tax', 'all_country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'state_id' => 'required|unique:state_taxes',
            'tax_percentage' => 'required|string|max:191',
            'country_id' => 'required|string|max:191',
        ]);

        $state_tax = StateTax::create([
            'state_id' => $request->state_id,
            'tax_percentage' => $request->tax_percentage,
            'country_id' => $request->country_id,
        ]);

        return $state_tax->id
            ? back()->with(FlashMsg::create_succeed('State Tax'))
            : back()->with(FlashMsg::create_failed('State Tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Tax\StateTax  $stateTax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
            'tax_percentage' => 'required|string|max:191',
            'country_id' => 'required|string|max:191',
        ]);

        $updated = StateTax::findOrFail($request->id)->update([
            'state_id' => $request->state_id,
            'tax_percentage' => $request->tax_percentage,
            'country_id' => $request->country_id,
        ]);

        return $updated
            ? back()->with(FlashMsg::update_succeed('State Tax'))
            : back()->with(FlashMsg::update_failed('State Tax'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tax\StateTax  $stateTax
     * @return \Illuminate\Http\Response
     */
    public function destroy(StateTax $item)
    {
        return $item->delete()
            ? back()->with(FlashMsg::delete_succeed('State Tax'))
            : back()->with(FlashMsg::delete_failed('State Tax'));
    }

    public function bulk_action(Request $request)
    {
        $deleted = StateTax::where('id', $request->ids)->delete();
        if ($deleted) {
            return 'ok';
        }
    }
}
