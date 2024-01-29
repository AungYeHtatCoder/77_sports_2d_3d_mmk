<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\WithDrawController;
use App\Http\Controllers\User\UserWalletController;
use App\Http\Controllers\User\TwodPlayIndexController;
use App\Http\Controllers\User\AM9\TwoDPlay9AMController;
use App\Http\Controllers\User\PM2\TwodPlay2PMController;
use App\Http\Controllers\User\PM4\TwodPlay4PMController;
use App\Http\Controllers\User\PM12\TwodPlay12PMController;
use App\Http\Controllers\User\Threed\ThreeDPlayController;


// Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'App\Http\Controllers\User', 'middleware' => ['auth']], function () {

//   Route::get('/two-d-play-index', [TwodPlayIndexController::class, 'index'])->name('twod-play-index');

//   // 9:00 am index
//   Route::get('/two-d-play-index-simple', [TwoDPlay9AMController::class, 'index'])->name('twod-play-index-9am');
//   // 9:00 am confirm page
//   Route::get('/two-d-play-9-30-early-morning-confirm', [TwoDPlay9AMController::class, 'play_confirm'])->name('twod-play-confirm-9am');
//   // store
//   Route::post('/two-d-play-index-9am', [TwoDPlay9AMController::class, 'store'])->name('twod-play-index-9am.store');


//   // 12:00 pm index
//   Route::get('/two-d-play-index-12pm', [TwodPlay12PMController::class, 'index'])->name('twod-play-index-12pm');
//   // 12:00 pm confirm page
//   Route::get('/two-d-play-12-1-morning-confirm', [TwodPlay12PMController::class, 'play_confirm'])->name('twod-play-confirm-12pm');
//   // store
//   Route::post('/two-d-play-index-12pm', [TwodPlay12PMController::class, 'store'])->name('twod-play-index-12pm.store');


//   // 2:00 pm index
//   Route::get('/two-d-play-index-2pm', [TwodPlay2PMController::class, 'index'])->name('twod-play-index-2pm');
//   // 2:00 pm confirm page
//   Route::get('/two-d-play-2-early-evening-confirm', [TwodPlay2PMController::class, 'play_confirm'])->name('twod-play-confirm-2pm');
//   // store
//   Route::post('/two-d-play-index-2pm', [TwodPlay2PMController::class, 'store'])->name('twod-play-index-2pm.store');


//   // 4:00 pm index
//   Route::get('/two-d-play-index-4pm', [TwodPlay4PMController::class, 'index'])->name('twod-play-index-4pm');
//   // 2:00 pm confirm page
//   Route::get('/two-d-play-4-30-evening-confirm', [TwodPlay4PMController::class, 'play_confirm'])->name('twod-play-confirm-4pm');
//   // store
//   Route::post('/two-d-play-index-4pm', [TwodPlay4PMController::class, 'store'])->name('twod-play-index-4pm.store');

//   // qick play 9:00 am index
//   Route::get('/two-d-quick-play-index', [App\Http\Controllers\User\TwodQuick\TwoDQicklyPlayController::class, 'index'])->name('twod-quick-play-index');
//   Route::get('/two-d-play-quick-confirm', [App\Http\Controllers\User\TwodQuick\TwoDQicklyPlayController::class, 'play_confirm'])->name('twod-play-confirm-quick');
//   // store
//   Route::post('/twod-play-quick-confirm', [App\Http\Controllers\User\TwodQuick\TwoDQicklyPlayController::class, 'store'])->name('twod-play-quickly-confirm.store');

//   // other route
//   Route::get('/two-d-winners-history', [App\Http\Controllers\User\WinnerHistoryController::class, 'winnerHistory'])->name('winnerHistory');



//   Route::get('/twod_history', [App\Http\Controllers\User\UserPlayTwoDHistoryRecordController::class, 'twodHistory'])->name('twodHistory');
//   // Route::get('/evening-play-history-record', [App\Http\Controllers\User\UserPlayTwoDHistoryRecordController::class, 'EveningPlayHistoryRecord']);

//   Route::get('/wallet-deposite', [App\Http\Controllers\User\UserWalletController::class, 'index'])->name('deposite-wallet');
//   Route::get('/fill-balance', [App\Http\Controllers\User\UserWalletController::class, 'topUpWallet'])->name('topUpWallet');

//   Route::get('/kpay-fill-balance-top-up-submit', [App\Http\Controllers\User\UserWalletController::class, 'topUpSubmit'])->name('topUpSubmit');

//   Route::get('/cb-pay-fill-balance-top-up-submit', [App\Http\Controllers\User\UserWalletController::class, 'CBPaytopUpSubmit'])->name('CBPaytopUpSubmit');

//   Route::get('/wave-pay-fill-balance-top-up-submit', [App\Http\Controllers\User\UserWalletController::class, 'WavePaytopUpSubmit'])->name('WavePaytopUpSubmit');

//   Route::get('/aya-pay-fill-balance-top-up-submit', [App\Http\Controllers\User\UserWalletController::class, 'AYAPaytopUpSubmit'])->name('AYAPaytopUpSubmit');

//   Route::post('/user-kpay-fill-money', [UserWalletController::class, 'StoreKpayFillMoney'])->name('StoreKpayFillMoney');

//   Route::post('/user-cb-pay-fill-money', [UserWalletController::class, 'StoreCBpayFillMoney'])->name('StoreCBpayFillMoney');

//   Route::post('/user-wave-pay-fill-money', [UserWalletController::class, 'StoreWavepayFillMoney'])->name('StoreWavepayFillMoney');

//   Route::post('/user-aya-pay-fill-money', [UserWalletController::class, 'StoreAYApayFillMoney'])->name('StoreAYApayFillMoney');
//   //withdraw
//   Route::get('/withdraw-money', [App\Http\Controllers\User\WithDrawController::class, 'GetWithdraw'])->name('money-withdraw');
//   Route::get('k-pay-withdraw-money', [WithDrawController::class, 'UserKpayWithdrawMoney'])->name('UserKpayWithdrawMoney');
//   Route::post('k-pay-with-draw-money', [WithDrawController::class, 'StoreKpayWithdrawMoney'])->name('StoreKpayWithdrawMoney');

//   Route::get('cb-pay-withdraw-money', [WithDrawController::class, 'UserCBPayWithdrawMoney'])->name('UserCBPayWithdrawMoney');
//   Route::post('cb-pay-with-draw-money', [WithDrawController::class, 'StoreCBpayWithdrawMoney'])->name('StoreCBpayWithdrawMoney');

//   Route::get('wave-pay-withdraw-money', [WithDrawController::class, 'UserWavePayWithdrawMoney'])->name('UserWavePayWithdrawMoney');
//   Route::post('wave-pay-with-draw-money', [WithDrawController::class, 'StoreWavepayWithdrawMoney'])->name('StoreWavepayWithdrawMoney');


//   Route::get('aya-pay-withdraw-money', [WithDrawController::class, 'UserAYAPayWithdrawMoney'])->name('UserAYAPayWithdrawMoney');
//   Route::post('aya-pay-with-draw-money', [WithDrawController::class, 'StoreAYApayWithdrawMoney'])->name('StoreAYApayWithdrawMoney');

//   // three d
//   Route::get('/three-d-play-index', [ThreeDPlayController::class, 'index'])->name('three-d-play-index');
//   // three d choice play
//   Route::get('/three-d-choice-play-index', [ThreeDPlayController::class, 'choiceplay'])->name('three-d-choice-play');
//   // three d choice play confirm
//   Route::get('/three-d-choice-play-confirm', [ThreeDPlayController::class, 'confirm_play'])->name('three-d-choice-play-confirm');
//   // three d choice play store
//   Route::post('/three-d-choice-play-store', [ThreeDPlayController::class, 'store'])->name('three-d-choice-play-store');
//   // display three d play
//   Route::get('/three-d-display', [ThreeDPlayController::class, 'user_play'])->name('display');
//   // three d dream book
//   Route::get('/three-d-dream-book', [App\Http\Controllers\User\Threed\ThreeDreamBookController::class, 'index'])->name('three-d-dream-book-index');
//   // three d winner history
//   Route::get('/three-d-winners-history', [App\Http\Controllers\User\Threed\ThreedWinnerHistoryController::class, 'index'])->name('three-d-winners-history');
//   Route::get('/user-dashboard', [App\Http\Controllers\User\WelcomeController::class, 'user_dashboard']);
//   // jackport play
//   Route::get('/jackport-play', [App\Http\Controllers\User\Jackpot\JackpotController::class, 'index'])->name('jackport-play');
//   // jackport play confirm
//   Route::get('/jackport-play-confirm', [App\Http\Controllers\User\Jackpot\JackpotController::class, 'play_confirm'])->name('jackport-play-confirm');
//   // jackport play store
//   Route::post('/jackport-play-store', [App\Http\Controllers\User\Jackpot\JackpotController::class, 'store'])->name('jackport-play-store');
//   // jackport play history
//   Route::get('/jackport-play-history', [App\Http\Controllers\User\Jackpot\JackpotController::class, 'OnceWeekJackpotHistory'])->name('jackport-play-history');
//   // jackport quick play
//   Route::get('/jackport-quick-play', [App\Http\Controllers\User\Jackpot\JackpotController::class, 'Quickindex'])->name('jackport-quick-play');
//   // jackport quick play confirm
//   Route::get('/jackport-quick-play-confirm', [App\Http\Controllers\User\Jackpot\JackpotController::class, 'Quickplay_confirm'])->name('jackport-quick-play-confirm');
//   // jackport quick play store
//   Route::post('/jackport-quick-play-store', [App\Http\Controllers\User\Jackpot\JackpotController::class, 'Quickstore'])->name('jackport-quick-play-store');
//   // jackport once month play history
//   Route::get('/jackport-once-month-play-history', [App\Http\Controllers\User\Jackpot\JackpotController::class, 'OnceMonthJackpotHistory'])->name('jackport-once-month-play-history');
//   // two d once month play history
//   Route::get('/two-d-once-month-play-history', [App\Http\Controllers\User\TwodPlayIndexController::class, 'TwoDigitOnceMonthHistory'])->name('two-d-once-month-play-history');
//   // three d once month play history
//   Route::get('/three-d-once-month-play-history', [App\Http\Controllers\User\Threed\ThreedWinnerHistoryController::class, 'OnceMonthThreeDHistory'])->name('three-d-once-month-play-history');
// });