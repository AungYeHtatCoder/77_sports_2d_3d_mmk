<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Promotion;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    use HttpResponses;
    public function promotion()
    {
        $promotions = Promotion::latest()->get();
        return $this->success($promotions, 'promotions');
    }

    public function promotionDetail($id)
    {
        $promotion = Promotion::find($id);
        return $this->success($promotion, 'promotion');
    }
}
