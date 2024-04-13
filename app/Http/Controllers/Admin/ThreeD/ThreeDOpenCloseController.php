<?php

namespace App\Http\Controllers\Admin\ThreeD;

use App\Http\Controllers\Controller;
use App\Models\Admin\LotteryMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function closeThreeD($id)
    {
        LotteryMatch::where('id', $id)->update(['is_active' => DB::raw('IF(is_active = 1, 0, 1)')]);
        
        return redirect()->back()->with('message', '3D Session Updated successfully!');
    }


}