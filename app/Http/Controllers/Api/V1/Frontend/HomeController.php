<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\BannerText;
use App\Models\Admin\Currency;
use App\Models\Admin\Game;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $user = Auth::user();
        $banners = Banner::latest()->take(3)->get();
        $banner_text = BannerText::latest()->first();
        $game_links = Game::latest()->get();
        $rate = Currency::latest()->first()->rate;
        return $this->success([
            'user' => $user,
            "banners" => $banners,
            "banner_text" => $banner_text,
            "game_links" => $game_links,
            "rate" => $rate,
        ]);
    }
}
