<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Commission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommissionController extends Controller
{
   public function index()
    {
       $commissions = Commission::all();
        return view('admin.commission.index', compact('commissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.commission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //dd($request->all());
        $validator = Validator::make($request->all(), [
        'commission' => 'required|unique:commissions,commission',

        //'body' => 'required|min:3'
    ]);

    if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
    }

        // store
        Commission::create([
            'commission' => $request->commission
        ]);
        // redirect
        //Alert::success('Premission has been Created successfully', 'WoW!');
        //toast::success('Success New Permission', 'Permission created successfully.');

        return redirect()->route('admin.commissions.index')->with('toast_success', 'commission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $commission_detail = Commission::find($id);
        return view('admin.commission.show', compact('commission_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $commission_edit = Commission::find($id);
        return view('admin.commission.edit', compact('commission_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        /// validate the request
        $request->validate([
            'commission' => 'required|unique:commissions,commission,' . $id,
        ]);
        // update
        $commission = Commission::findOrFail($id);
        $commission->update([
            'commission' => $request->commission
        ]);
        // redirect
        return redirect()->route('admin.permissions.index')->with('toast_success', 'commission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $commission = Commission::findOrFail($id);
        $commission->delete();
        return redirect()->route('admin.permissions.index')->with('toast_success', 'Permission deleted successfully.');
    }
}