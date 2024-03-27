<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BankController;

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;


use App\Http\Controllers\Admin\BannerController;

use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\PlayTwoDController;
use App\Http\Controllers\Admin\TwoDigitController;
use App\Http\Controllers\Admin\PromotionController;

use App\Http\Controllers\Admin\TwoDLimitController;


use App\Http\Controllers\Admin\BannerTextController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ThreeDListController;
use App\Http\Controllers\Admin\TwoDWinnerController;
use App\Http\Controllers\Admin\ThreeDLimitController;
use App\Http\Controllers\Admin\TransferLogController;
use App\Http\Controllers\Admin\TwoDLotteryController;

use App\Http\Controllers\Admin\TwoDMorningController;
use App\Http\Controllers\Home\CashInRequestController;
use App\Http\Controllers\Admin\ThreedHistoryController;
use App\Http\Controllers\Home\CashOutRequestController;
use App\Http\Controllers\Admin\TwoD\DataLejarController;
use App\Http\Controllers\Admin\TwoD\TwoDLagarController;
use App\Http\Controllers\Admin\ThreedMatchTimeController;
use App\Http\Controllers\Admin\FillBalanceReplyController;
use App\Http\Controllers\Admin\ThreeD\ThreeDCloseController;
use App\Http\Controllers\Admin\ThreeD\ThreeDLegarController;
use App\Http\Controllers\Admin\TwoD\CloseTwoDigitController;
use App\Http\Controllers\Admin\TwoD\HeadDigitCloseController;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// sub route
require __DIR__ . '/auth.php';
require __DIR__ . '/two_d_play.php';
require __DIR__ . '/frontend.php';

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth']], function () {
    // Permissions
    Route::delete('permissions/destroy', [PermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionController::class);
    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);
    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);
    Route::get('/two-d-users', [App\Http\Controllers\Admin\TwoUsersController::class, 'index'])->name('two-d-users-index');
    // details route
    Route::get('/two-d-users/{id}', [App\Http\Controllers\Admin\TwoUsersController::class, 'show'])->name('two-d-users-details');
    //Banners
    Route::resource('banners', BannerController::class);
    Route::resource('text', BannerTextController::class);
    Route::resource('games', GameController::class);
    Route::resource('/promotions', PromotionController::class);
    Route::resource('/banks', BankController::class);
    //commissions route
    Route::resource('/commissions', CommissionController::class);
    // Two Digit Limit
    Route::resource('/two-digit-limit', TwoDLimitController::class);
    // three Ditgit Limit
    Route::resource('/three-digit-limit', ThreeDLimitController::class);
    // two digit close 
    Route::resource('two-digit-close', CloseTwoDigitController::class);
    // morning - lajar 
    Route::get('/morning-lajar', [TwoDLagarController::class, 'showData'])->name('morning-lajar');
    // two digit data
    Route::get('/two-digit-lejar-data', [DataLejarController::class, 'showData'])->name('two-digit-lejar-data');

    // morning - lajar 
    Route::get('/evening-lajar', [TwoDLagarController::class, 'showDataEvening'])->name('evening-lajar');
    // two digit data
    Route::get('/evening-two-digit-lejar-data', [DataLejarController::class, 'showDataEvening'])->name('evening-two-digit-lejar-data');
    // three digit close
    Route::resource('three-digit-close', ThreeDCloseController::class);
    // three digit legar
    Route::get('/three-digit-lejar', [ThreeDLegarController::class, 'showData'])->name('three-digit-lejar');
    // display limit 
    Route::get('/three-d-display-limit-amount', [App\Http\Controllers\Admin\ThreeDLimitController::class, 'overLimit'])->name('three-d-display-limit-amount');
    Route::get('/three-d-same-id-display-limit-amount', [App\Http\Controllers\Admin\ThreeDLimitController::class, 'SameThreeDigitIDoverLimit'])->name('three-d-display-same-id-limit-amount');
    // head digit close 
    Route::resource('head-digit-close', HeadDigitCloseController::class);
    //cash in lists
    Route::get('/cashIn', [CashInRequestController::class, 'index'])->name('cashIn');
    Route::get('/cashIn/{id}', [CashInRequestController::class, 'show'])->name('cashIn.show');
    Route::post('/cashIn/accept/{id}', [CashInRequestController::class, 'accept'])->name('acceptCashIn');
    Route::post('/cashIn/reject/{id}', [CashInRequestController::class, 'reject'])->name('rejectCashIn');
    Route::post('/transfer/{id}', [CashInRequestController::class, "transfer"]);
    //cash out lists
    Route::get('/cashOut', [CashOutRequestController::class, 'index'])->name('cashOut');
    Route::get('/cashOut/{id}', [CashOutRequestController::class, 'show'])->name('cashOut.show');
    Route::post('/cashOut/accept/{id}', [CashOutRequestController::class, 'accept'])->name('acceptCashOut');
    Route::post('/cashOut/reject/{id}', [CashOutRequestController::class, 'reject'])->name('rejectCashOut');
    // Route::post('/withdraw/{id}', [CashOutRequestController::class, "withdraw"]);
    //transfer logs lists
    Route::get('/transferlogs', [TransferLogController::class, 'index'])->name('transferLog');
    
    
    //Currency
    Route::resource('currency', CurrencyController::class);
    // profile resource rotues
    Route::resource('profiles', ProfileController::class);
    // user profile route get method
    Route::put('/change-password', [ProfileController::class, 'newPassword'])->name('changePassword');
    // PhoneAddressChange route with auth id route with put method
    Route::put('/change-phone-address', [ProfileController::class, 'PhoneAddressChange'])->name('changePhoneAddress');
    Route::put('/change-kpay-no', [ProfileController::class, 'KpayNoChange'])->name('changeKpayNo');
    Route::put('/change-join-date', [ProfileController::class, 'JoinDate'])->name('addJoinDate');
    Route::get('/get-three-d', [App\Http\Controllers\Admin\ThreeDPlayController::class, 'GetThreeDigit'])->name('GetThreeDigit');
    Route::get('/three-d-play', [App\Http\Controllers\Admin\ThreeDPlayController::class, 'ThreeDigitPlay'])->name('ThreeDigitPlay');
    Route::get('/three-d-play-confirm', [App\Http\Controllers\Admin\ThreeDPlayController::class, 'ThreeDigitPlayConfirm'])->name('ThreeDigitPlayConfirm');
    Route::get('/three-d-play-confirm-api-format', [App\Http\Controllers\Admin\ThreeDPlayController::class, 'ThreeDigitPlayConfirmApi'])->name('ThreeDigitPlayConfirmApi');
    
    Route::post('/three-digit-play-confirm', [App\Http\Controllers\Admin\ThreeDigitPlayController::class, 'ThreeDigitPlaystore'])->name('ThreeDigitPlaystore');

    Route::get('/quick-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickMorningPlayTwoDigit'])->name('QuickMorningPlayTwoDigit');
    Route::get('/quick-odd-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickOddMorningPlayTwoDigit'])->name('QuickOddMorningPlayTwoDigit');
    Route::get('/quick-even-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickEvenMorningPlayTwoDigit'])->name('QuickEvenMorningPlayTwoDigit');

    Route::get('/quick-odd-same-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickOddSameMorningPlayTwoDigit'])->name('QuickOddSameMorningPlayTwoDigit');

    Route::get('/quick-even-same-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickEvenSameMorningPlayTwoDigit'])->name('QuickEvenSameMorningPlayTwoDigit');
    Route::post('/quick-two-d-play', [App\Http\Controllers\Admin\TwoDPlayController::class, 'Quickstore'])->name('Quickstore');

    Route::get('/two-d-play-noti', [App\Http\Controllers\Admin\GetNotificationTwoDPlayUserController::class, 'index'])->name('two-d-play-noti');
    Route::post('/two-d-play-noti-mark-as-read', [App\Http\Controllers\Admin\GetNotificationTwoDPlayUserController::class, 'playTwoDmarkNotification'])->name('playTwoDmarkNotification');

    Route::get('/get-two-d-session-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'index'])->name('SessionResetIndex');
    Route::post('/two-d-session-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'SessionReset'])->name('SessionReset');
    Route::get('/close-two-d', [App\Http\Controllers\Admin\CloseTwodController::class, 'index'])->name('CloseTwoD');
    Route::put('/update-open-close-two-d', [App\Http\Controllers\Admin\CloseTwodController::class, 'update'])->name('OpenCloseTwoD');
    Route::resource('twod-records', TwoDLotteryController::class);
    Route::resource('tow-d-win-number', TwoDWinnerController::class);
    Route::resource('tow-d-morning-number', TwoDMorningController::class);
    // two d get early morning number
    Route::get('/get-two-d-early-morning-number', [App\Http\Controllers\Admin\TwoDMorningController::class, 'GetDigitEarlMorningindex'])->name('earlymorningNumber');
    Route::get('/get-two-d-early-evening-number', [App\Http\Controllers\Admin\TwoDMorningController::class, 'GetDigitEarlyEveningindex'])->name('earlyeveningNumber');
    // early morning winner
    Route::get('/two-d-early-morning-winner', [App\Http\Controllers\Admin\TwoDMorningWinnerController::class, 'TwoDEarlyMorningWinner'])->name('earlymorningWinner');
    Route::get('/two-d-morning-winner', [App\Http\Controllers\Admin\TwoDMorningWinnerController::class, 'TwoDMorningWinner'])->name('morningWinner');
    Route::get('/two-d-evening-number', [App\Http\Controllers\Admin\TwoDMorningController::class, 'EveningTwoD'])->name('eveningNumber');

    Route::get('/two-d-early-evening-winner', [App\Http\Controllers\Admin\TwoDMorningController::class, 'TwoDEarlyEveningWinner'])->name('earlyeveningWinner');

    Route::get('/two-d-evening-winner', [App\Http\Controllers\Admin\TwoDMorningController::class, 'TwoDEveningWinner'])->name('eveningWinner');
    Route::get('/two-d-evening-winner', [App\Http\Controllers\Admin\TwoDEveningWinnerController::class, 'TwoDEveningWinner'])->name('eveningWinner');
    Route::get('profile/fill_money', [ProfileController::class, 'fillmoney']);
    // kpay fill money get route
    Route::get('profile/kpay_fill_money', [ProfileController::class, 'index'])->name('kpay_fill_money');
    Route::resource('fill-balance-replies', FillBalanceReplyController::class);
    Route::get('/daily-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmounts'])->name('dailyIncomeJson');
    Route::get('/with-draw-view', [App\Http\Controllers\Admin\WithDrawViewController::class, 'index'])->name('withdrawViewGet');
    Route::get('/with-draw-details/{id}', [App\Http\Controllers\Admin\WithDrawViewController::class, 'show'])->name('withdrawViewDetails');
    // withdraw update route
    Route::put('/with-draw-update/{id}', [App\Http\Controllers\Admin\WithDrawViewController::class, 'update'])->name('withdrawViewUpdate');
    Route::get('/daily-with-name-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsDaily'])->name('getTotalAmountsDaily');
    // week name route
    Route::get('/weekly-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsWeekly'])->name('getTotalAmountsWeekly');
    // month name route
    Route::get('/month-with-name-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsMonthly'])->name('getTotalAmountsMonthly');
    // year name route
    Route::get('/yearly-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsYearly'])->name('getTotalAmountsYearly');
    Route::get('/two-d-users', [App\Http\Controllers\Admin\TwoUsersController::class, 'index'])->name('two-d-users-index');
    // details route
    Route::get('/two-d-users/{id}', [App\Http\Controllers\Admin\TwoUsersController::class, 'show'])->name('two-d-users-details');
    //Banners
    Route::resource('banners', BannerController::class);
    // profile resource rotues
    Route::resource('profiles', ProfileController::class);
    Route::put('/super-admin-update-balance/{id}', [App\Http\Controllers\Admin\ProfileController::class, 'AdminUpdateBalance'])->name('admin-update-balance');
    // user profile route get method
    Route::put('/change-password', [ProfileController::class, 'newPassword'])->name('changePassword');
    // PhoneAddressChange route with auth id route with put method
    Route::put('/change-phone-address', [ProfileController::class, 'PhoneAddressChange'])->name('changePhoneAddress');
    Route::put('/change-kpay-no', [ProfileController::class, 'KpayNoChange'])->name('changeKpayNo');
    Route::put('/change-join-date', [ProfileController::class, 'JoinDate'])->name('addJoinDate');
    Route::resource('play-twod', PlayTwoDController::class);
    Route::get('/get-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'GetTwoDigit'])->name('GetTwoDigit');
    Route::post('lotteries-two-d-play', [TwoDigitController::class, 'store'])->name('StorePlayTwoD');
    Route::get('/morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'MorningPlayTwoDigit'])->name('MorningPlayTwoDigit');

    Route::get('/evening-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'EveningPlayTwoDigit'])->name('EveningPlayTwoDigit');

    Route::post('lotteries-two-d-play', [TwoDigitController::class, 'store'])->name('StorePlayTwoD');
   
    Route::post('/two-d-play', [App\Http\Controllers\Admin\TwoDPlayController::class, 'store'])->name('two-d-play.store');
    Route::get('/quick-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickMorningPlayTwoDigit'])->name('QuickMorningPlayTwoDigit');
    Route::get('/quick-odd-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickOddMorningPlayTwoDigit'])->name('QuickOddMorningPlayTwoDigit');
    Route::get('/quick-even-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickEvenMorningPlayTwoDigit'])->name('QuickEvenMorningPlayTwoDigit');

    Route::get('/quick-odd-same-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickOddSameMorningPlayTwoDigit'])->name('QuickOddSameMorningPlayTwoDigit');

    Route::get('/quick-even-same-morning-play-two-d', [App\Http\Controllers\Admin\TwoDPlayController::class, 'QuickEvenSameMorningPlayTwoDigit'])->name('QuickEvenSameMorningPlayTwoDigit');
    Route::post('/quick-two-d-play', [App\Http\Controllers\Admin\TwoDPlayController::class, 'Quickstore'])->name('Quickstore');
    Route::get('/two-d-play-noti', [App\Http\Controllers\Admin\GetNotificationTwoDPlayUserController::class, 'index'])->name('two-d-play-noti');
    Route::post('/two-d-play-noti-mark-as-read', [App\Http\Controllers\Admin\GetNotificationTwoDPlayUserController::class, 'playTwoDmarkNotification'])->name('playTwoDmarkNotification');

    Route::get('/get-two-d-session-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'index'])->name('SessionResetIndex');
    Route::post('/two-d-session-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'SessionReset'])->name('SessionReset');
    Route::get('/close-two-d', [App\Http\Controllers\Admin\CloseTwodController::class, 'index'])->name('CloseTwoD');
    Route::put('/update-open-close-two-d', [App\Http\Controllers\Admin\CloseTwodController::class, 'update'])->name('OpenCloseTwoD');
    Route::resource('twod-records', TwoDLotteryController::class);
    Route::resource('tow-d-win-number', TwoDWinnerController::class);
    Route::resource('tow-d-morning-number', TwoDMorningController::class);
    Route::get('/two-d-morning-winner', [App\Http\Controllers\Admin\TwoDMorningWinnerController::class, 'TwoDMorningWinner'])->name('morningWinner');
    Route::get('/two-d-evening-number', [App\Http\Controllers\Admin\TwoDMorningController::class, 'EveningTwoD'])->name('eveningNumber');
    Route::get('/two-d-evening-winner', [App\Http\Controllers\Admin\TwoDMorningController::class, 'TwoDEveningWinner'])->name('eveningWinner');
    Route::get('/two-d-evening-winner', [App\Http\Controllers\Admin\TwoDEveningWinnerController::class, 'TwoDEveningWinner'])->name('eveningWinner');
    Route::get('profile/fill_money', [ProfileController::class, 'fillmoney']);
    // kpay fill money get route
    Route::get('profile/kpay_fill_money', [ProfileController::class, 'index'])->name('kpay_fill_money');
    Route::resource('fill-balance-replies', FillBalanceReplyController::class);
    Route::get('/daily-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmounts'])->name('dailyIncomeJson');
    Route::get('/with-draw-view', [App\Http\Controllers\Admin\WithDrawViewController::class, 'index'])->name('withdrawViewGet');
    Route::get('/with-draw-details/{id}', [App\Http\Controllers\Admin\WithDrawViewController::class, 'show'])->name('withdrawViewDetails');
    // withdraw update route
    Route::put('/with-draw-update/{id}', [App\Http\Controllers\Admin\WithDrawViewController::class, 'update'])->name('withdrawViewUpdate');
    Route::get('/daily-with-name-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsDaily'])->name('getTotalAmountsDaily');
    // week name route
    Route::get('/weekly-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsWeekly'])->name('getTotalAmountsWeekly');
    // month name route
    Route::get('/month-with-name-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsMonthly'])->name('getTotalAmountsMonthly');
    // year name route
    Route::get('/yearly-income-json', [App\Http\Controllers\Admin\DailyTwodIncomeOutComeController::class, 'getTotalAmountsYearly'])->name('getTotalAmountsYearly');

    // 3d lottery routes
    Route::get('/threed-lotteries-history', [ThreedHistoryController::class, 'index']);
    Route::get('/threed-lotteries-match-time', [ThreedMatchTimeController::class, 'index']);
    // 3d prize number create
    Route::get('/three-d-prize-number-create', [App\Http\Controllers\Admin\ThreeD\ThreeDPrizeNumberCreateController::class, 'index'])->name('three-d-prize-number-create');
    // store_permutations
    Route::post('/store-permutations', [App\Http\Controllers\Admin\ThreeD\ThreeDPrizeNumberCreateController::class, 'PermutationStore'])->name('storePermutations'); 
    //deletePermutation
    Route::delete('/delete-permutation/{id}', [App\Http\Controllers\Admin\ThreeD\ThreeDPrizeNumberCreateController::class, 'deletePermutation'])->name('deletePermutation');
    Route::post('/three-d-prize-number-create', [App\Http\Controllers\Admin\ThreeD\ThreeDPrizeNumberCreateController::class, 'store'])->name('three-d-prize-number-create.store');
    // 3d history
    Route::get('/three-d-history', [App\Http\Controllers\Admin\ThreeD\ThreeDRecordHistoryController::class, 'index'])->name('three-d-history');
    // 3d history show
    Route::get('/three-d-history-show/{id}', [App\Http\Controllers\Admin\ThreeD\ThreeDRecordHistoryController::class, 'show'])->name('three-d-history-show');
    // three d list index
    Route::get('/three-d-list-index', [App\Http\Controllers\Admin\ThreeD\ThreeDListController::class, 'index'])->name('three-d-list-index');
    // three d list show
    Route::get('/three-d-list-show/{id}', [App\Http\Controllers\Admin\ThreeD\ThreeDListController::class, 'show'])->name('three-d-list-show');
    // 3d winner list
    Route::get('/three-d-winner', [App\Http\Controllers\Admin\ThreeD\ThreeDWinnerController::class, 'index'])->name('three-d-winner');
    
    Route::post('/two-d-session-over-amount-limit-reset', [App\Http\Controllers\Admin\SessionResetControlller::class, 'OverAmountLimitSessionReset'])->name('OverAmountLimitSessionReset');
        // three d reset
        Route::post('/three-d-reset', [App\Http\Controllers\Admin\ThreeD\ThreeDResetController::class, 'ThreeDReset'])->name('ThreeDReset');

    // jack pot
    Route::get('/once-week-jackpot-list', [App\Http\Controllers\Admin\Jackpot\JackpotController::class, 'index'])->name('displayjackpot');
    // jackpot one month history
    Route::get('/jackpot-one-month-history', [App\Http\Controllers\Admin\Jackpot\JackpotController::class, 'getOneMonthJackpotHistory'])->name('JackpotHistory');
    Route::get('/jackpot-one-month-history-only-digit', [App\Http\Controllers\Admin\Jackpot\JackpotController::class, 'getOneMonthJackpotHistoryOnlyDigit'])->name('JackpotHistoryDigit');
    // jack pot show
    Route::get('/once-week-jackpot-show/{id}', [App\Http\Controllers\Admin\Jackpot\JackpotController::class, 'show'])->name('displayjackpotshow');
    // jack pot history
    Route::get('/jackpot-history', [App\Http\Controllers\Admin\Jackpot\JackpotHistoryController::class, 'JackpotHistoryindex'])->name('jackpotHistory');

    // jack pot history show
    Route::get('/jackpot-history-show/{id}', [App\Http\Controllers\Admin\Jackpot\JackpotHistoryController::class, 'JackpotHistoryshow'])->name('jackpotHistoryshow');
    // jackpot over
    Route::get('/jackpot-over', [App\Http\Controllers\Admin\Jackpot\JackpotOverLimitController::class, 'overLimit'])->name('jackpot-over');
    // jackpot over same id
    Route::get('/jackpot-over-same-id', [App\Http\Controllers\Admin\Jackpot\JackpotOverLimitController::class, 'SameThreeDigitIDoverLimit'])->name('jackpot-over-same-id');
    // jackpot prize number create
    Route::get('/jackpot-prize-number-create', [App\Http\Controllers\Admin\Jackpot\JackpotController::class, 'Jackpotindex'])->name('jackpot-prize-number-create');
    // jackpot prize number store
    Route::post('/jackpot-prize-number-store', [App\Http\Controllers\Admin\Jackpot\JackpotController::class, 'store'])->name('jackpot-prize-number-create.store');

     Route::post('/jackpot-reset', [App\Http\Controllers\Admin\Jackpot\JackpotController::class, 'JackpotReset'])->name('JackpotReset');
     // jackpot one week history conclude
        Route::get('/jackpot-one-week-history-conclude', [App\Http\Controllers\Admin\Jackpot\JackpotController::class, 'OnceWeekJackpotHistoryConclude'])->name('JackpotHistoryConclude');
        // three digit history conclude
        Route::get('/three-digit-history-conclude', [App\Http\Controllers\Admin\ThreeD\ThreeDRecordHistoryController::class, 'OnceWeekThreedigitHistoryConclude'])->name('ThreeDigitHistoryConclude');
        // three digit one month history conclude
        Route::get('/three-digit-one-month-history-conclude', [App\Http\Controllers\Admin\ThreeD\ThreeDRecordHistoryController::class, 'OnceMonthThreedigitHistoryConclude'])->name('ThreeDigitOneMonthHistoryConclude');
        // jackpot history 
        Route::get('/jackpot-history', [App\Http\Controllers\Admin\Jackpot\JackpotWinnerHistoryController::class, 'getWinnersHistoryForAdmin'])->name('JackpotHistory');
        // three d winners history
        Route::get('/three-d-winners-history', [App\Http\Controllers\Admin\ThreeD\ThreeDWinnerController::class, 'getWinnersHistoryForAdmin'])->name('ThreeDWinnersHistory'); 
        // three d permutation winners history
        Route::get('/permutation-winners-history', [App\Http\Controllers\Admin\ThreeD\ThreeDWinnerController::class, 'getPermutationWinnersHistoryForAdmin'])->name('PermutationWinnersHistory'); 
        // greater than less than winner prize
        Route::resource('winner-prize', App\Http\Controllers\Admin\ThreeD\GreatherThanLessThanWinnerPrizeController::class);
        // three d permutation winner prize
        Route::get('/prize-winners', [App\Http\Controllers\Admin\ThreeD\ThreeDWinnerController::class, 'getPrizeWinnersHistoryForAdmin'])->name('getPrizeWinnersHistory'); 
        // two d winner history
     Route::get('/admin-two-d-winners-history', [App\Http\Controllers\Admin\TwoDWinnerHistoryController::class, 'getWinnersHistoryForAdmin'])->name('winnerHistoryForAdmin');
    Route::get('/admin-two-d-winners-history-group-by-session', [App\Http\Controllers\Admin\TwoDWinnerHistoryController::class, 'getWinnersHistoryForAdminGroupBySession'])->name('winnerHistoryForAdminSession');

    // two d commission route
    Route::get('/two-d-commission', [App\Http\Controllers\Admin\Commission\TwoDCommissionController::class, 'getTwoDTotalAmountPerUser'])->name('two-d-commission'); 

    // show details
    Route::get('/two-d-commission-show/{id}', [App\Http\Controllers\Admin\Commission\TwoDCommissionController::class, 'show'])->name('two-d-commission-show');
    Route::put('/two-d-commission-update/{id}', [App\Http\Controllers\Admin\Commission\TwoDCommissionController::class, 'update'])->name('two-d-commission-update');
    // commission update
   Route::post('two-d-transfer-commission/{id}', [App\Http\Controllers\Admin\Commission\TwoDCommissionController::class, 'TwoDtransferCommission'])->name('two-d-transfer-commission');
    
    // three d commission route
    Route::get('/three-d-commission', [App\Http\Controllers\Admin\Commission\ThreeDCommissionController::class, 'getThreeDTotalAmountPerUser'])->name('three-d-commission');
    // show details 
    Route::get('/three-d-commission-show/{id}', [App\Http\Controllers\Admin\Commission\ThreeDCommissionController::class, 'show'])->name('three-d-commission-show');
    // three_d_commission_update
    Route::put('/three-d-commission-update/{id}', [App\Http\Controllers\Admin\Commission\ThreeDCommissionController::class, 'update'])->name('three-d-commission-update');
    // transfer commission route
    Route::post('/three-d-transfer-commission/{id}', [App\Http\Controllers\Admin\Commission\ThreeDCommissionController::class, 'ThreeDtransferCommission'])->name('three-d-transfer-commission');
    // show transfer commission


    // jackpot commission route
    Route::get('/jackpot-commission', [App\Http\Controllers\Admin\Commission\JackpotCommissionController::class, 'getJackpotTotalAmountPerUser'])->name('jackpot-commission');
    Route::get('/jackpot-commission-show/{id}', [App\Http\Controllers\Admin\Commission\JackpotCommissionController::class, 'show'])->name('jackpot-commission-show');
    Route::put('/jackpot-commission-update/{id}', [App\Http\Controllers\Admin\Commission\JackpotCommissionController::class, 'update'])->name('jackpot-commission-update');
    // commission update
   Route::post('jackpot-transfer-commission/{id}', [App\Http\Controllers\Admin\Commission\JackpotCommissionController::class, 'JackpottransferCommission'])->name('jackpot-transfer-commission');
    
   // TwodDailyMorningHistory
    Route::get('/twod-daily-morning-history', [App\Http\Controllers\Admin\DailyMorningHistoryController::class, 'TwodDailyMorningHistory'])->name('TwodDailyMorningHistory');
    // TwodDailyEveningHistory
    Route::get('/twod-daily-evening-history', [App\Http\Controllers\Admin\DailyMorningHistoryController::class, 'TwodDailyEveningHistory'])->name('TwodDailyEveningHistory');
});