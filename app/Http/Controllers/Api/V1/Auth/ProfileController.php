<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use App\Rules\PasswordCheck;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthApi\ProfileRequest;
use App\Http\Requests\AuthApi\PasswordRequest;

class ProfileController extends Controller
{
    use HttpResponses;
    public function profile()
    {
        // $rate = Currency::latest()->first()->rate;
        return $this->success([
            "user" => Auth::user(),
            // "currency_rate" => $rate
        ]);
    }
    public function error($data, $status, $headers = []) {
        // Create a response with the provided data, status code, and headers
        $response = response()->json($data, $status, $headers);

        // Return the response
        return $response;
    }

    public function updateProfile(ProfileRequest $request)
    {
        $request->validated($request->all());
        $user = Auth::user();
        if($user->profile){
            File::delete(public_path('assets/img/profile/' . $user->profile));
        }
        if($request->hasFile('profile'))
        {
            $image = $request->file('profile');
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid('profile') . '.' . $ext;
            $image->move(public_path('assets/img/profile/'), $filename);
        }else{
            $filename = $user->profile;
        }

        $user->update([
            "name" => $request->name ?? $user->name,
            "phone" => $request->phone ?? $user->phone,
            "profile" => $filename,
        ]);
        return $this->success([
            "message" => "Profile updated successfully",
        ]);
    }

    public function changePassword(PasswordRequest $request)
    {
        $request->validate([
            'old_password' => ['required', new PasswordCheck()],
            'password' => 'required|min:6',
        ]);
        $user = Auth::user();
        if(Hash::check($request->old_password, $user->password)){
            $user->update([
                "password" => Hash::make($request->password),
            ]);
            return $this->success([
                "message" => "Password changed successfully",
            ]);
        }else{
            return $this->error([
                "message" => "Old password does not match",
            ], 401);
        }
    }

    public function balanceUpdateApi(Request $request)
    {
        $user = User::find(Auth::id());
        $commission = $request->balance;

        // Check if the user has enough balance before making deductions
        if($commission > $user->commission_balance){
            return $this->error([
                "message" => "You don't have enough balance",
            ], 401);
        }

        $user->balance += $commission;
        // commission_balance deduct
        $user->commission_balance -= $commission;
        $user->save();

        // Return the updated user data and a success message as a JSON response
        return response()->json([
            'user' => $user,
            'message' => 'Balance updated successfully'
        ], 200);
    }

}