@extends('layouts.admin_app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">အောက်နှစ်လုံးထီ Detail | {{ $lottery->user->name }} - Dashboards
                                <span>
                                    <button type="button" class="btn btn-success">
                                        <span>Account Balance</span>
                                        <span class="badge badge-primary">{{ $lottery->user->balance }}</span>
                                    </button>
                                </span>
                            </h5>

                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="{{ url('/admin/once-week-jackpot-list') }}"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Back To အောက်နှစ်လုံးထီ List </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="card-header">
                         <div class="d-lg-flex">
                          
                         </div>
                        </div>
                    <h6>အောက်နှစ်လုံးထီ Details</h6>
                    <p><strong>Total Amount: - စုစုပေါင်းထိုးကြေး </strong> {{ $lottery->total_amount }}</p>

                    {{-- Displaying two digits associated with the lottery --}}
                    <h6>Three Digits &nbsp; &nbsp; &nbsp; &nbsp;
                        <span>{{ $lottery->user->name }} ထိုးထားသော ဂဏန်းများ </span>
                    </h6>
                    <table class="table table-flush">
                        <thead>
                            <tr>

                                 <th>#</th>
                                <th>အောက်နှစ်လုံးထီ</th>
                                <th>Sub Amount</th>
                                <th>Date</th>
                                <th>Prize</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lottery->twoDigits as $index => $jackpot_Digit)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $jackpot_Digit->two_digit }}</td>
                                    <td>{{ $jackpot_Digit->pivot->sub_amount }}</td>
                                    <td class="text-sm font-weight-normal">
                                        <span
                                            class="badge bg-gradient-info">{{ $lottery->created_at->format('d-m-Y (l) (h:i a)') }}</span>
                                    </td>
                                    {{-- @if ($prize_no)
                                        <td>{{ $prize_no['prize_no'] }}</td>
                                    @else --}}
                                        <td>
                                            @if($prize_no == null)
                                                <span class="badge bg-gradient-warning">Pending</span>
                                            @elseif($jackpot_Digit->two_digit == $prize_no['prize_no'])
                                                <span class="badge bg-gradient-success">Win</span>
                                            @else
                                                <span class="badge bg-gradient-danger">Lose</span>
                                            @endif
                                        </td>

                                    {{-- @endif --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
