<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Currency;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            $user = User::find(Auth::user()->id);
            $currency = Currency::latest()->first();
            return view('admin.profile.admin_profile', compact('user', 'currency'));
        } else {
            $user = User::find(Auth::user()->id);
            $currency = Currency::latest()->first();
            return view('frontend.user_profile', compact('user', 'currency'));
        }
        //return view('admin.profile.index');
    }
    //UserProfile
    public function UserProfile()
    {
        if (auth()->user()->hasRole('Admin')) {
            $user = User::find(Auth::user()->id);
            $currency = Currency::latest()->first();
            return view('admin.profile.admin_profile', compact('user', 'currency'));
        } else {
            $user = User::find(Auth::user()->id);
            return view('user_profile', compact('user'));
        }
        //return view('admin.profile.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    public function update(UserRequest $request, User $user)
    {
        $request->validate([
            'profile' => 'required|image'
        ]);
        if (Auth::user()->profile) {
            //remove banner from localstorage
            File::delete(public_path('assets/img/profile/' . $user->profile));
        }
        // image
        $image = $request->file('profile');
        $ext = $image->getClientOriginalExtension();
        $filename = uniqid('profile') . '.' . $ext; // Generate a unique filename
        $image->move(public_path('assets/img/profile/'), $filename); // Save the file

        Auth::user()->update([
            'profile' => $filename,
        ]);

        return redirect()->back()->with('toast_success', 'Profile updated successfully');
    }
    // new password change function
    public function newPassword(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'password' => 'required|min:8',

        ]);

        $user = User::find(Auth::user()->id);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('toast_success', "Customer Password has been Updated.");
    }


    // password change function
    public function changePassword(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',

        ]);

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            if (auth()->user()->hasRole('Admin')) {
                return redirect()->back()->with('toast_success', "Admin Password has been  Updated.");
            } else {
                return redirect()->back()->with('toast_success', "Customer Password has been Updated.");
            }
        } else {
            return redirect()->back()->with('error', "Old password does not match!");
        }
    }

    // phone address update function
    public function PhoneAddressChange(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'phone' => 'required',
            'address' => 'required',

        ]);

        $user = User::find(Auth::user()->id);

        $user->update([
            'name' => $request->name, // 'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        if (auth()->user()->hasRole('Admin')) {
            return redirect()->back()->with('toast_success', "Admin Profile has been  Updated.");
        } else {
            return redirect()->back()->with('toast_success', "Customer Profile has been Updated.");
        }
    }

    public function KpayNoChange(Request $request)
    {
        //dd($request->all());
        // $request->validate([
        //     'kpay_no' => 'required',
        // ]);

        $user = User::find(Auth::user()->id);

        $user->update([
            'kpay_no' => $request->kpay_no,
            'cbpay_no' => $request->cbpay_no,
            'wavepay_no' => $request->wavepay_no,
            'ayapay_no' => $request->ayapay_no,
        ]);

        if (auth()->user()->hasRole('Admin')) {
            return redirect()->back()->with('toast_success', "Admin Profile has been  Updated.");
        } else {
            return redirect()->back()->with('toast_success', "Customer Profile has been Updated.");
        }
    }

    public function JoinDate(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'join_date' => 'required',
        ]);
        $formattedJoinDate = Carbon::createFromFormat('m/d/Y', $request->input('join_date'))->format('Y-m-d');

        $user = User::find(Auth::user()->id);

        $user->update([
            'join_date' => $formattedJoinDate,
        ]);

        if (auth()->user()->hasRole('Admin')) {
            return redirect()->back()->with('toast_success', "Admin Profile has been  Updated.");
        } else {
            return redirect()->back()->with('toast_success', "Customer Profile has been Updated.");
        }
    }


    // user profile info 
    public function editInfo(Request $request)
    {
        $request->validate([
            "name" => "required",
            "phone" => ['nullable', 'string', 'min:11'],

        ]);

        $user = User::find(Auth::id());

        if (
            $request->phone !== $user->phone
        ) {

            $existingPhone = User::where("phone", $request->phone)->first();

            if ($existingPhone && $existingPhone->id !== $user->id) {
                return redirect()->back()->with("error", "The phone has already been taken.");
            }
        }

        $user->update([
            "name" => $request->name,
            "phone" => $request->phone ?? $user->phone,

        ]);

        return redirect()->back()->with("success", "User info updated successfully.");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function saveImage(UploadedFile $image)
    {
        $path = 'profile_image/' . Str::random();
        //$path = 'images/product_image';

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }

        return $path . '/' . $image->getClientOriginalName();
    }

    public function fillmoney()
    {
        return view('admin.profile.fill_money');
    }
}
