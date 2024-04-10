<?php

namespace App\Http\Controllers\Admin\ThreeD;

use Illuminate\Http\Request;
use App\Models\Admin\LotteryMatch;
use App\Http\Controllers\Controller;

class ThreeDOpenCloseController extends Controller
{
    public function update(Request $request)
{
    //dd($request->all());
    $isActive = $request->has('flexSwitchCheckDefault'); 

    $matchId = $request->input('is_active'); 
    $match = LotteryMatch::find($matchId);
    //return $match; // This line is removed, as it was preventing the update operation from executing
    if($match) {
        $match->is_active = $isActive;
        $match->save();
    }
    return redirect()->back()->with('message', 'Match status updated successfully!');
}

}