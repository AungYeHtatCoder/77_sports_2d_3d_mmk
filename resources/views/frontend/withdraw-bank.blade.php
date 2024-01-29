@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
@auth
  <!-- kyat-baht -->
  <div class="my-2 d-flex justify-content-around align-items-center" style="padding-top: 80px;">
    <div class="money currency-active" id="mmk">Kyat / ကျပ်</div>
    <img src="{{ asset('user_app/assets/img/arrow.png') }}" width="32px" height="32px" alt="" />
    <div class="money" id="bht">Baht / ဘတ်</div>
  </div>

  <div class="d-flex justify-content-around align-items-center mx-auto mmk" style="
            background-color: var(--default);
            width: 358px;
            height: 59px;
            border-radius: 24px;
            border: 2px solid var(--gold, #576265);
            background: #12486b;
            padding: 12px 16px;
          ">
    <img src="{{ asset('user_app/assets/img/vector.png') }}" width="24px" height="24px" alt="" />
    <p class="pt-3" style="font-size: 16px; font-weight: 500">ပိုက်ဆံအိတ် </p>
    <p class="pt-3" style="
              font-size: 16px;
              font-weight: 700;
              font-family: 'Lato', sans-serif;
            ">
      {{ number_format(Auth::user()->balance) }} Kyats
    </p>

    <img src="{{ asset('user_app/assets/img/plus.png') }}" class="rounded-circle" style="padding: 10px; color: var(--blue); background-color: #fff" alt="" />
  </div>
  <div class="d-flex justify-content-around align-items-center mx-auto d-none bht" style="
            background-color: var(--default);
            width: 358px;
            height: 59px;
            border-radius: 24px;
            border: 2px solid var(--gold, #576265);
            background: #12486b;
            padding: 12px 16px;
          ">
    <img src="{{ asset('user_app/assets/img/vector.png') }}" width="24px" height="24px" alt="" />
    <p class="pt-3" style="font-size: 16px; font-weight: 500">ပိုက်ဆံအိတ် </p>
    <p class="pt-3" style="
              font-size: 16px;
              font-weight: 700;
              font-family: 'Lato', sans-serif;
            ">
      @php
          $rate = App\Models\Admin\Currency::latest()->first()->rate;
          // dd($rate);
      @endphp
      {{ number_format(Auth::user()->balance / $rate) }} Bahts
    </p>

    <img src="{{ asset('user_app/assets/img/plus.png') }}" class="rounded-circle" style="padding: 10px; color: var(--blue); background-color: #fff" alt="" />
  </div>
@endauth
<!-- choose bank start -->
<div class="my-3 px-3">
  <div class="text-dark" style="
            font-family: Noto Sans Myanmar;
            font-size: 20px;
            font-weight: 600;
            line-height: 44px;
            letter-spacing: 0em;
            text-align: left;
            color: #5a5a5a;
          ">
    <p>မိမိငွေထုတ်မည့်ဘဏ်တစ်ခုရွေးပါ</p>
  </div>
  <div class="row">
    @foreach ($banks as $bank)
    <div class="col-6 mb-3">
      <a href="{{ route('withdraw', $bank->id) }}">
        <img src="{{ $bank->img_url }}" class="img-fluid rounded-5 shadow" alt="">
      </a>
    </div>
    @endforeach
  </div>
  {{-- <div class="d-flex justify-content-center align-items-center">
    <a href="{{ route('withdraw') }}" class="text-decoration-none"><img src="{{ asset('user_app/assets/img/kpay.png') }}" class="px-2 m-2" alt="" /></a>
    <a href="{{ route('withdraw') }}" class="text-decoration-none"><img src="{{ asset('user_app/assets/img/aya.png') }}" class="px-2 m-2" alt="" /></a>
  </div>
  <div class="d-flex justify-content-center align-items-center">
    <a href="{{ route('withdraw') }}" class="text-decoration-none"><img src="{{ asset('user_app/assets/img/wave.png') }}" class="px-2 m-2" alt="" /></a>
    <a href="{{ route('withdraw') }}" class="text-decoration-none"><img src="{{ asset('user_app/assets/img/cb.png') }}" class="px-2 m-2" alt="" /></a>
  </div> --}}
</div>

<!-- choose band end -->
@include('user_layout.footer')
@endsection