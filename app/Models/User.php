<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Models\Admin\Role;
use App\Models\Admin\Event;
use App\Models\Admin\Lottery;
use App\Models\Admin\Currency;
use App\Models\Admin\TwodWiner;
use App\Models\Jackpot\Jackpot;
use App\Models\Admin\BetLottery;
use App\Models\Admin\Permission;
use App\Models\ThreeDigit\Lotto;
use App\Models\Admin\FillBalance;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\LotteryTwoDigit;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country_code',
        'phone',
        'profile',
        'email',
        'password',
        'address',
        'kpay_no',
        'cbpay_no',
        'wavepay_no',
        'ayapay_no',
        'balance',
        'commission_balance',
        'user_currency',
    ];
    protected $appends = ['img_url'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getIsUserAttribute()
    {
        return $this->roles()->where('id', 2)->exists();
    }


    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);

    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // public function event()
    // {
    //     return $this->hasOne(Event::class);
    // }


    public function hasRole($role)
    {
        return $this->roles->contains('title', $role);
    }

    public function hasPermission($permission)
    {
        return $this->roles->flatMap->permissions->pluck('title')->contains($permission);
    }

    // currency relationship
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function lotteries()
{
    return $this->hasMany(Lottery::class);
}
 
 // jackpot relationship
 public function jackpots()
{
    return $this->hasMany(Jackpot::class);
}

public function twodWiners()
    {
        return $this->belongsToMany(TwodWiner::class);
    }

 public function balancedecrement($column, $amount = 1)
    {
        $this->$column = $this->$column - $amount;
        return $this->save();
    }
   
    public function fillBalances()
    {
        return $this->hasMany(FillBalance::class);
    }

    public static function getUserEarlyMorningTwoDigits($userId) {
    $morningTwoDigits = Lottery::where('user_id', $userId)
                               ->with('twoDigitsEarlyMorning')
                               ->get()
                               ->pluck('twoDigitsEarlyMorning')
                               ->collapse(); // Collapse the collection to a single dimension

    // Sum the sub_amount from the pivot table
    $totalAmount = $morningTwoDigits->sum(function ($twoDigit) {
        return $twoDigit->pivot->sub_amount;
    });

    return [
        'two_digits' => $morningTwoDigits,
        'total_amount' => $totalAmount
    ];
}

    public static function getUserMorningTwoDigits($userId) {
        $morningTwoDigits = Lottery::where('user_id', $userId)
                                ->with('twoDigitsMorning')
                                ->get()
                                ->pluck('twoDigitsMorning')
                                ->collapse(); // Collapse the collection to a single dimension

        // Sum the sub_amount from the pivot table
        $totalAmount = $morningTwoDigits->sum(function ($twoDigit) {
            return $twoDigit->pivot->sub_amount;
        });

        return [
            'two_digits' => $morningTwoDigits,
            'total_amount' => $totalAmount
        ];
    }

    public static function getUserEarlyEveningTwoDigits($userId) {
        $morningTwoDigits = Lottery::where('user_id', $userId)
                                ->with('twoDigitsEarlyEvening')
                                ->get()
                                ->pluck('twoDigitsEarlyEvening')
                                ->collapse(); // Collapse the collection to a single dimension

        // Sum the sub_amount from the pivot table
        $totalAmount = $morningTwoDigits->sum(function ($twoDigit) {
            return $twoDigit->pivot->sub_amount;
        });

        return [
            'two_digits' => $morningTwoDigits,
            'total_amount' => $totalAmount
        ];
    }


    public static function getUserEveningTwoDigits($userId) {
        $morningTwoDigits = Lottery::where('user_id', $userId)
                                ->with('twoDigitsEvening')
                                ->get()
                                ->pluck('twoDigitsEvening')
                                ->collapse(); // Collapse the collection to a single dimension

        // Sum the sub_amount from the pivot table
        $totalAmount = $morningTwoDigits->sum(function ($twoDigit) {
            return $twoDigit->pivot->sub_amount;
        });

        return [
            'two_digits' => $morningTwoDigits,
            'total_amount' => $totalAmount
        ];
    }

    // three d
    public function betLotteries()
    {
        return $this->hasMany(BetLottery::class);
    }

    public function getImgUrlAttribute()
    {
        return asset('assets/img/profile/' . $this->profile);
    }


    public static function getUserThreeDigits($userId) {
    $displayThreeDigits = Lotto::where('user_id', $userId)
                               ->with('DisplayThreeDigits')
                               ->get()
                               ->pluck('DisplayThreeDigits')
                               ->collapse(); 
    $totalAmount = $displayThreeDigits->sum(function ($threeDigit) {
        return $threeDigit->pivot->sub_amount;
    });
    // DisplayThreeDigitsOver
    $displayThreeDigitsOver = Lotto::where('user_id', $userId)
                               ->with('DisplayThreeDigitsOver')
                               ->get()
                               ->pluck('DisplayThreeDigitsOver')
                               ->collapse();
    $totalAmountOver = $displayThreeDigitsOver->sum(function ($threeDigit) {
        return $threeDigit->pivot->sub_amount;
    });
    $totalAmountBoth = $totalAmount + $totalAmountOver;
    return [
        'threeDigit' => $displayThreeDigits,
        'total_amount' => $totalAmount,
        'threeDigitOver' => $displayThreeDigitsOver,
        'total_amount_over' => $totalAmountOver,
        'total_amount_both' => $totalAmountBoth
    ];
}

// jackpot 
//     public static function getUserJackpotDigits($userId) {
//     $displayJackpotDigits = Jackpot::where('user_id', $userId)
//                                ->with('DisplayJackpotDigits')
//                                ->get()
//                                ->pluck('DisplayJackpotDigits')
//                                ->collapse(); 
//     $totalAmount = $displayJackpotDigits->sum(function ($jackpotDigit) {
//         return $jackpotDigit->pivot->sub_amount;
//     });
//     return [
//         'jackpotDigit' => $displayJackpotDigits,
//         'total_amount' => $totalAmount,
//     ];
// }
// Assuming this is in a controller or similar
        public static function getUserJackpotDigits($userId)
        {
            $jackpots = Jackpot::where('user_id', $userId)->with('DisplayJackpotDigits')->get();

            $displayJackpotDigits = $jackpots->flatMap->displayJackpotDigits;
            $totalAmount = $displayJackpotDigits->sum(function ($jackpotDigit) {
                return $jackpotDigit->pivot->sub_amount;
            });

            return [
                'jackpotDigit' => $displayJackpotDigits,
                'total_amount' => $totalAmount,
            ];
        }

// jackpot admin
                public static function getAdminJackpotDigitsHistory()
        {
            $jackpots = Jackpot::with('DisplayJackpotDigits')->get();

            $displayJackpotDigits = $jackpots->flatMap->displayJackpotDigits;
            $totalAmount = $displayJackpotDigits->sum(function ($jackpotDigit) {
                return $jackpotDigit->pivot->sub_amount;
            });

            return [
                'jackpotDigit' => $displayJackpotDigits,
                'total_amount' => $totalAmount,
            ];
        }
        // // one week history
        //  public static function getAdminthreeDigitsHistory()
        // {
        //     $jackpots = Lotto::with('displayThreeDigitsOneWeekHistory')->get();

        //     $displayJackpotDigits = $jackpots->flatMap->displayJackpotDigits;
        //     $totalAmount = $displayJackpotDigits->sum(function ($jackpotDigit) {
        //         return $jackpotDigit->pivot->sub_amount;
        //     });

        //     return [
        //         'threeDigit' => $displayJackpotDigits,
        //         'total_amount' => $totalAmount,
        //     ];
        // }

            public static function getAdminthreeDigitsHistory()
    {
        $jackpots = Lotto::with('displayThreeDigitsOneWeekHistory')->get();

        $displayJackpotDigits = $jackpots->flatMap(function ($jackpot) {
            return $jackpot->displayThreeDigitsOneWeekHistory;
        });
        $totalAmount = $displayJackpotDigits->sum('pivot.sub_amount');

        return [
            'threeDigit' => $displayJackpotDigits,
            'total_amount' => $totalAmount,
        ];
    }

    // one week three ditgy for api response
     public static function getAdminthreeDigitsHistoryApi($userId)
    {
        $jackpots = Lotto::where('user_id', $userId)->with('displayThreeDigitsOneWeekHistory')->get();

        $displayJackpotDigits = $jackpots->flatMap(function ($jackpot) {
            return $jackpot->displayThreeDigitsOneWeekHistory;
        });
        $totalAmount = $displayJackpotDigits->sum('pivot.sub_amount');

        return [
            'threeDigit' => $displayJackpotDigits,
            'total_amount' => $totalAmount,
        ];
    }
    // three d one month history for api respone
    public static function getAdminthreeDigitsOneMonthHistoryApi($userId)
    {
        $jackpots = Lotto::where('user_id', $userId)->with('displayThreeDigitsOneMonthHistory')->get();

        $displayJackpotDigits = $jackpots->flatMap(function ($jackpot) {
            return $jackpot->displayThreeDigitsOneWeekHistory;
        });
        $totalAmount = $displayJackpotDigits->sum('pivot.sub_amount');

        return [
            'threeDigit' => $displayJackpotDigits,
            'total_amount' => $totalAmount,
        ];
    }


    // three d one month history for admin 
    public static function getAdminthreeDigitsOneMonthHistory()
    {
        $jackpots = Lotto::with('displayThreeDigitsOneMonthHistory')->get();

        $displayJackpotDigits = $jackpots->flatMap(function ($jackpot) {
            return $jackpot->displayThreeDigitsOneWeekHistory;
        });
        $totalAmount = $displayJackpotDigits->sum('pivot.sub_amount');

        return [
            'threeDigit' => $displayJackpotDigits,
            'total_amount' => $totalAmount,
        ];
    }





public static function getAdminJackpotDigits() {
    $displayJackpotDigits = Jackpot::with('displayJackpotDigits')
                               ->get()
                               ->pluck('displayJackpotDigits')
                               ->collapse(); 
    $totalAmount = $displayJackpotDigits->sum(function ($jackpotDigit) {
        return $jackpotDigit->pivot->sub_amount;
    });
    return [
        'jackpotDigit' => $displayJackpotDigits,
        'total_amount' => $totalAmount,
    ];
}

// jackpot one month
public static function getUserOneMonthJackpotDigits($userId) {
    $jackpots = Jackpot::where('user_id', $userId)->with('user')->get();
    $jackpotIds = $jackpots->pluck('id')->toArray();

    $displayJackpotDigits = $jackpots->flatMap(function ($jackpot) use ($jackpotIds) {
        return $jackpot->displayJackpotDigits($jackpotIds)->get();
    });

    $totalAmount = $displayJackpotDigits->sum('pivot_sub_amount');

    return [
        'jackpotDigit' => $displayJackpotDigits,
        'total_amount' => $totalAmount,
    ];
}
    // get two digit one month history
    public static function getUserOneMonthTwoDigits($userId) {
    $displayTwoDigits = Lottery::where('user_id', $userId)
                               ->with('twoDigitsOnceMonth')
                               ->get()
                               ->pluck('twoDigitsOnceMonth')
                               ->collapse(); // Collapse the collection to a single dimension
    $totalAmount = $displayTwoDigits->sum(function ($twoDigit) {
        return $twoDigit->pivot->sub_amount;
    });
    return [
        'two_digits' => $displayTwoDigits,
        'total_amount' => $totalAmount
    ];
}

// get three digit one month history
public static function getUserOneMonthThreeDigits($userId) {
    $displayThreeDigits = Lotto::where('user_id', $userId)
                               ->with('DisplayThreeDigitsOnceMonth')
                               ->get()
                               ->pluck('DisplayThreeDigitsOnceMonth')
                               ->collapse(); // Collapse the collection to a single dimension
    $totalAmount = $displayThreeDigits->sum(function ($threeDigit) {
        return $threeDigit->pivot->sub_amount;
    });
    return [
        'three_digits' => $displayThreeDigits,
        'total_amount' => $totalAmount
    ];
}


// get two digit daily history for morning (Admin)

 public static function getAdmin2dDailyMorningHistory()
{
    $twodigits = Lottery::with('Admin2DMorningHistory')->get();

    $displaytwoDigits = $twodigits->flatMap(function ($twodigit) {
        return $twodigit->Admin2DMorningHistory;
    });
    $totalAmount = $displaytwoDigits->sum('pivot.sub_amount');

    return [
        'twoDigit' => $displaytwoDigits,
        'total_amount' => $totalAmount,
    ];
}

public static function getAdmin2dDailyEveningHistory()
{
    $twodigits = Lottery::with('Admin2DEveningHistory')->get();

    $displaytwoDigits = $twodigits->flatMap(function ($twodigit) {
        return $twodigit->Admin2DMorningHistory;
    });
    $totalAmount = $displaytwoDigits->sum('pivot.sub_amount');

    return [
        'twoDigit' => $displaytwoDigits,
        'total_amount' => $totalAmount,
    ];
}
    
}