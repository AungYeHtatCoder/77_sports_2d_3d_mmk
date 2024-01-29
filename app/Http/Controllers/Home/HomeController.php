<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\BannerText;
use App\Models\Admin\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->take(3)->get();
        $marqueeText = BannerText::latest()->first();
        $games = Game::latest()->get();

        return view('welcome', compact('banners', 'marqueeText', 'games'));
    }
}
