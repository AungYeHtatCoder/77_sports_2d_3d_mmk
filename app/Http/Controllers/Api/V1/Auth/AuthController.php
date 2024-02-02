<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthApi\LoginRequest;
use App\Http\Requests\AuthApi\RegisterRequest;
use App\Models\Admin\CountryCode;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;
    public function login(LoginRequest $request)
    {
        $request->validated($request->all());
        $country_code = "+95";
        $credentials = $request->only($country_code, 'phone', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('phone', $request->phone)->first();
            return $this->success([
                'user' => $user,
                'token' => $user->createToken('Api Token of '. $user->name)->plainTextToken
            ], "Logged In Successfully.");
        } else {
            return $this->error("", "ဖုန်းနံပါတ်(သို့)လျို့ဝှက်နံပါတ် မှားယွင်းနေပါသည်။", 401);
        }
    }

    public function loginData()
    {
        $country_codes = CountryCode::all();
        return $this->success([
            'country_codes' => $country_codes,
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'country_code' => "+95",
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        $user->roles()->sync(4);
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of '.$user->name)->plainTextToken
        ], "User Registered Successfully.");
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete(); 
        return $this->success([
            'message' => 'Logged out successfully.'
        ]);
    }
}