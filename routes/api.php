<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TestController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\Jackpot\JackpotController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Frontend\HomeController;
use App\Http\Controllers\Api\V1\Frontend\TwoDController;
use App\Http\Controllers\Api\V1\Frontend\ThreeDController;
use App\Http\Controllers\Api\V1\Frontend\WalletController;
use App\Http\Controllers\Api\V1\Frontend\PromotionController;
use App\Http\Controllers\Api\Jackpot\JackpotOneWeekGetDataController;
use App\Http\Controllers\Api\V1\Frontend\TwoDRemainingAmountController;





//publish routes
Route::get('/login', [AuthController::class, 'loginData']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//protected routes
Route::group(["middleware" => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    
    //profile management
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::post('/profile', [ProfileController::class, 'updateProfile']);
    Route::post('/profile/changePassword', [ProfileController::class, 'changePassword']);

    //Home Routes
    Route::get('/home', [HomeController::class, 'index']);

    //Wallet Routes
    Route::get('/wallet', [WalletController::class, 'banks']);
    Route::get('/wallet/bank/{id}', [WalletController::class, 'bankDetail']);
    Route::post('/wallet/deposit', [WalletController::class, 'deposit']);
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw']);
    Route::get('/wallet/transferLogs', [WalletController::class, 'transferLog']);

    //Promotion Routes
    Route::get('/promotions', [PromotionController::class, 'promotion']);
    Route::get('/promotion/{id}', [PromotionController::class, 'promotionDetail']);

    //2D Routes
    Route::get('/twoD', [TwoDController::class, 'index']);
    Route::post('/twoD/play', [TwoDController::class, 'play']);
    Route::get('/twoD/playHistory', [TwoDController::class, 'playHistory']); //unfinished
    // for admin 
    Route::get('/two-d-play-history-for-admin', [TwoDController::class, 'playHistoryForAdmin'])->name('TwoDPlayHistoryForAdmin');

    //3D Routes
    Route::get('/threeD', [ThreeDController::class, 'index']);
    Route::post('/threeD/play', [ThreeDController::class, 'play']);
    Route::get('/threeD/playHistory', [ThreeDController::class, 'playHistory']); //unfinished
    // two once month history
    Route::get('/twoDigitOnceMonthHistory', [TwoDController::class, 'TwoDigitOnceMonthHistory']);
    // three once month history
    Route::get('/threeDigitOnceMonthHistory', [ThreeDController::class, 'OnceMonthThreeDHistory']);
    // jackpot once month history
    Route::get('/jackpotOnceMonthHistory', [JackpotOneWeekGetDataController::class, 'OnceMonthJackpotHistory']);
    // jackpot play
    Route::post('/jackpot-play', [JackpotController::class, 'store']);
    // three digit one week play history
    Route::get('/threeDigitOneWeekHistory', [ThreeDController::class, 'OnceWeekThreedigitHistoryConclude']);
    // three digit one month play history
    Route::get('/threeDigitOneMonthHistory', [ThreeDController::class, 'OnceMonthThreedigitHistoryConclude']);

     Route::get('/jackpot-winner-history', [App\Http\Controllers\Admin\Jackpot\JackpotWinnerHistoryController::class, 'getWinnersHistoryForAdminApi'])->name('JackpotHistory');
     // three digit winner history
        Route::get('/three-digit-winner-history', [App\Http\Controllers\Admin\ThreeD\ThreeDWinnerController::class, 'getWinnersHistoryForAdminApi'])->name('ThreeDigitHistory');
        // two digit winner history
     Route::get('/two-d-winners-history-group-by-session', [App\Http\Controllers\Admin\TwoDWinnerHistoryController::class, 'getWinnersHistoryForAdminGroupBySessionApi'])->name('winnerHistoryForAdminSession');
     // commission balance update 
    Route::post('/balance-update', [ProfileController::class, 'balanceUpdateApi']);
    Route::get('/two-d-remaining-amount', [TwoDRemainingAmountController::class, 'index'])->name('twod.play.remaining.amount');
    // auth winner history 
    Route::get('/auth-winner-history', [App\Http\Controllers\Api\V1\ThreeD\AuthWinnerHistoryController::class, 'getWinnersHistoryForAuthUserOnly'])->name('authWinnerHistory');
    // auth two digit winner history
    Route::get('/auth-two-d-winner-history', [App\Http\Controllers\Api\V1\ThreeD\AuthWinnerHistoryController::class, 'TwoDigitWinnerHistory'])->name('authTwoDigitWinnerHistory');
    
});