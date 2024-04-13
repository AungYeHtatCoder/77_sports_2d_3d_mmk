<?php

namespace App\Http\Controllers\Admin\ThreeD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThreeDigit\Permutation;

class PermutationResetController extends Controller
{
    public function PermutationReset()
    {
        Permutation::truncate();
        session()->flash('SuccessRequest', 'Successfully 3D Permutation Reset.');
        return redirect()->back()->with('message', 'Data reset successfully!');
    }
}