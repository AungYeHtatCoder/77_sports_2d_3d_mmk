<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TwoUsersController extends Controller
{
    public function index()
{
    abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden |You cannot  Access this page because you do not have permission');
     
    // users data with order by id desc, excluding the user with id = 1
    $users = User::where('id', '<>', 1)->orderBy('id', 'desc')->with('roles')->get();
    return response()->view('admin.two_d.user_index', compact('users'));
}

// show user details
public function show($id)
{
    abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden |You cannot  Access this page because you do not have permission');
     
    // get user data with id
    $user = User::findOrFail($id);
    return response()->view('admin.two_d.two_d_user_show', compact('user'));

}
}