<?php

namespace App\Http\Controllers\Admin\Jackpot;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Jackpot\Jackpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Jackpot\JackpotLimit;
use App\Models\Jackpot\JackpotWinner;
use App\Models\User\JackpotTwoDigitCopy;

class JackpotController extends Controller
{
    // public function OnceWeekJackpotHistory()
    // {
    //     $displayJackpotDigit = User::getAdminJackpotDigits();
    //      $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    //      $prize_no_jackpot = JackpotWinner::whereDate('created_at', Carbon::today())
    //                               ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    //                               ->orderBy('id', 'desc')
    //                               ->first();
    //     return view('admin.jackpot.onec_week_jackpot_history', [
    //         'displayThreeDigits' => $displayJackpotDigit,
    //         'prize_no' => $prize_no,
    //         'prize_no_jackpot' => $prize_no_jackpot,
    //     ]);
    // }
    public function index()
    {
            $today = Carbon::now();
            if ($today->day <= 1) {
                $targetDay = 1;
            } else {
            $targetDay = 16;
            // If today is after the 16th, then target the 1st of next month
            if ($today->day > 16) {
                $today->addMonthNoOverflow();
                $today->day = 1;
            }
        }
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
       // i want to show only once week jackpot history start from 1st to 17th and 16th to 2st
        $start = Carbon::now()->startOfMonth();
        $end_in_st_17 = Carbon::now()->startOfMonth()->addDays(16);
        $statr_in_nd_2 = Carbon::now()->startOfMonth()->addDays(17);
        $end = Carbon::now()->endOfMonth();
        $lotteries = Jackpot::with(['JackpotDigits', 'lotteryMatch.threedMatchTime'])
        ->whereBetween('created_at', [$start, $end_in_st_17])
        ->orWhereBetween('created_at', [$statr_in_nd_2, $end])
        ->orderBy('id', 'desc')->get();

        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    
        return view('admin.jackpot.once_week_jackpot_history', compact('lotteries', 'prize_no', 'matchTime'));
    }
    
    public function show(string $id)
    {
        $lottery = Jackpot::with('twoDigits')->findOrFail($id);
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        $today = Carbon::now();
        if ($today->day <= 1) {
            $targetDay = 1;
        } else {
            $targetDay = 16;
            // If today is after the 16th, then target the 1st of next month
            if ($today->day > 16) {
                $today->addMonthNoOverflow();
                $today->day = 1;
            }
        }
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
        return view('admin.jackpot.jackpot_show', compact('lottery', 'prize_no', 'matchTime'));
    }

    public function JackpotHistoryindex()
    {
            $today = Carbon::now();
            if ($today->day <= 1) {
                $targetDay = 1;
            } else {
            $targetDay = 16;
            // If today is after the 16th, then target the 1st of next month
            if ($today->day > 16) {
                $today->addMonthNoOverflow();
                $today->day = 1;
            }
        }
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
        $lotteries = Jackpot::with(['twoDigits', 'lotteryMatch.threedMatchTime'])->orderBy('id', 'desc')->get();
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    
        return view('admin.jackpot.once_week_jackpot_history', compact('lotteries', 'prize_no', 'matchTime'));
    }
    
    public function JackpotHistoryshow(string $id)
    {
        $lottery = Jackpot::with('twoDigits')->findOrFail($id);
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        $today = Carbon::now();
        if ($today->day <= 1) {
            $targetDay = 1;
        } else {
            $targetDay = 16;
            // If today is after the 16th, then target the 1st of next month
            if ($today->day > 16) {
                $today->addMonthNoOverflow();
                $today->day = 1;
            }
        }
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
        return view('admin.jackpot.jackpot_show', compact('lottery', 'prize_no', 'matchTime'));
    }

    public function Jackpotindex()
    {
        
        $three_digits_prize = JackpotWinner::orderBy('id', 'desc')->first();
        return view('admin.jackpot.prize_index', compact('three_digits_prize'));
    }

    public function JackpotReset()
    {
        JackpotTwoDigitCopy::truncate();
        session()->flash('SuccessRequest', 'Successfully အောက်နှစ်လုံး Reset.');
    return redirect()->back()->with('message', 'Data reset successfully!');
    }

    // public function getOneMonthJackpotHistory()
    // {
    //     $oneMonthAgo = Carbon::now()->subMonth();

    //     $history = DB::table('jackpot_two_digit')
    //         ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
    //         ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
    //         ->join('users', 'jackpots.user_id', '=', 'users.id')
    //         ->where('jackpot_two_digit.created_at', '>=', $oneMonthAgo)
    //         ->select('jackpot_two_digit.*', 'jackpots.pay_amount', 'jackpots.total_amount', 'two_digits.two_digit', 'users.name as user_name')
    //         ->orderBy('jackpot_two_digit.created_at', 'desc')
    //         ->get();

    //     return view('admin.jackpot.one_month_history', compact('history'));
    // }

    // public function getOneMonthJackpotHistory()
    // {
    //     $startDate = Carbon::now()->subMonth()->startOfMonth();
    //     $endDate = Carbon::now()->subMonth()->endOfMonth();

    //     $history = DB::table('jackpot_two_digit')
    //         ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
    //         ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
    //         ->join('users', 'jackpots.user_id', '=', 'users.id')
    //         ->whereBetween('jackpot_two_digit.created_at', [$startDate, $endDate])
    //         ->select(DB::raw('MONTH(jackpot_two_digit.created_at) as month'), DB::raw('YEAR(jackpot_two_digit.created_at) as year'), DB::raw('SUM(jackpots.pay_amount) as total_pay_amount'), DB::raw('SUM(jackpots.total_amount) as total_total_amount'))
    //         ->groupBy(DB::raw('MONTH(jackpot_two_digit.created_at)'), DB::raw('YEAR(jackpot_two_digit.created_at)'))
    //         ->orderBy('jackpot_two_digit.created_at', 'desc')
    //         ->get();

    //     //dd($history);

    //     return view('admin.jackpot.one_month_history', compact('history'));
    // }

    public function getOneMonthJackpotHistory()
    {
            $today = Carbon::now();
            if ($today->day <= 1) {
                $targetDay = 1;
            } else {
            $targetDay = 16;
            // If today is after the 16th, then target the 1st of next month
            if ($today->day > 16) {
                $today->addMonthNoOverflow();
                $today->day = 1;
            }
        }
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
        $history = Jackpot::with(['twoDigits', 'lotteryMatch.threedMatchTime'])->orderBy('id', 'desc')->get();
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    
        return view('admin.jackpot.one_month_history', compact('history', 'prize_no', 'matchTime'));
    }

    public function getOneMonthJackpotHistoryOnlyDigit()
    {
            $today = Carbon::now();
            if ($today->day <= 1) {
                $targetDay = 1;
            } else {
            $targetDay = 16;
            // If today is after the 16th, then target the 1st of next month
            if ($today->day > 16) {
                $today->addMonthNoOverflow();
                $today->day = 1;
            }
        }
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
        $history = Jackpot::with(['twoDigits', 'lotteryMatch.threedMatchTime'])->orderBy('id', 'desc')->get();
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    
        return view('admin.jackpot.one_month_history_only_digit', compact('history', 'prize_no', 'matchTime'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    //$currentSession = date('H') < 12 ? 'morning' : 'evening';  // before 1 pm is morning

        JackpotWinner::create([
            'prize_no' => $request->prize_no,
            //'session' => $currentSession,
        ]);
        session()->flash('SuccessRequest', 'Three Digit Lottery Prize Number Created Successfully');

        return redirect()->back()->with('success', 'Three Digit Lottery Prize Number Created Successfully');
    }

    public function OnceWeekJackpotHistoryConclude()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getAdminJackpotDigitsHistory();
        $jackpot_limits = JackpotLimit::orderBy('id', 'desc')->first();
        return view('admin.jackpot.one_week_conclude', [
            'displayThreeDigits' => $displayJackpotDigit,
            'jackpot_limits' => $jackpot_limits,
        ]);
    }


}