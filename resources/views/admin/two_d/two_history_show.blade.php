@extends('layouts.admin_app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">2D History Detail | {{ $lottery->user->name }} - Dashboards
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
                                <a href="{{ route('admin.twod-records.index') }}"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Back To 2D List </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    {{-- Displaying lottery details --}}
                    <h6>Lottery Details</h6>
                    <p><strong>Pay Amount: - ထိုးကြေး</strong> {{ $lottery->pay_amount }}</p>
                    <p><strong>Total Amount: - စုစုပေါင်းထိုးကြေး </strong> {{ $lottery->total_amount }}</p>

                    {{-- Displaying two digits associated with the lottery --}}
                    <h6>Two Digits &nbsp; &nbsp; &nbsp; &nbsp;
                        <span>{{ $lottery->user->name }} ထိုးထားသော ဂဏန်းများ </span>
                    </h6>
                    <table class="table table-flush">
                        <thead>
                            <tr>
                                <th>2D</th>
                                <th>Sub Amount</th>
                                <th>Date</th>
                                <th>Prize</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lottery->twoDigits as $twoDigit)
                                <tr>
                                    <td>{{ $twoDigit->id }}</td>
                                    <td>{{ $twoDigit->pivot->sub_amount }}</td>
                                    <td class="text-sm font-weight-normal">
                                        <span
                                            class="badge bg-gradient-info">{{ $lottery->created_at->format('d-m-Y (l) (h:i a)') }}</span>
                                    </td>
                                    @if ($prize_no)
                                        <td></td>
                                    @else
                                        <td>
                                            @if ($twoDigit->two_digit == $prize_no)
                                                <span class="badge bg-gradient-success">Win</span>
                                            @else
                                                <span class="badge bg-gradient-danger">Lose</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
