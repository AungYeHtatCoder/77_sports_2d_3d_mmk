<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LotteryMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CloseTwodController extends Controller
{
    public function index()
    {
        // get lottery matches first
        //$lottery_matches = LotteryMatch::all();
        $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

        return view('admin.two_d.close_twod' , compact('lottery_matches'));
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $isActive = $request->has('flexSwitchCheckDefault'); // This will return true if checkbox is checked, false otherwise

        // Assuming you want to update a specific match by id
        $matchId = $request->input('is_active'); // You'll need to send this as a hidden field in the form

        $match = LotteryMatch::find($matchId);
        if($match) {
            $match->is_active = $isActive;
            $match->save();
        }

        return redirect()->back()->with('message', 'Match status updated successfully!');
    }

    public function closeTwoD($id)
    {
        LotteryMatch::where('id', $id)->update(['is_active' => DB::raw('IF(is_active = 1, 0, 1)')]);
        
        return redirect()->back()->with('message', '2D Session Updated successfully!');
    }
    
}