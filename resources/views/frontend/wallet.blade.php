@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<!-- profile section start -->
@include('user_layout.profile')
<!-- profile section end -->
@auth
  <!-- kyat-baht -->
  <div class="my-2 d-flex justify-content-around align-items-center">
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

<div class="d-flex justify-content-between align-items-center my-2 mx-auto" style="
          width: 358px;
          height: 90px;
          border: 1px solid #1c30e0;
          padding: 12px 16px;
          border-radius: 24px;
        ">
  <a href="{{ route('topupBank') }}">
    <div class="menus">
      <img src="{{ asset('user_app/assets/img/2D/money-withdrawal 1.png') }}" width="20px" height="20px" alt="" />
    </div>
    <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
      ငွေဖြည့်
    </p>
  </a>

  <a href="{{ route('withdrawBank') }}">
    <div class="menus">
      <img src="{{ asset('user_app/assets/img/2D/send-money 1.png') }}" width="20px" height="20px" alt="" />
    </div>
    <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
      ငွေထုတ််
    </p>
  </a>

  <a href="{{ route('transferlog') }}">
    <div class="menus">
      <img src="{{ asset('user_app/assets/img/2D/receipt.png') }}" width="20px" height="20px" alt="" />
    </div>
    <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
      မှတ်တမ်း
    </p>
  </a>
</div>

<!-- wallet info start -->
<div class="wallet text-dark pb-3 mx-3" style="font-size: 12px">
  <div class="wallet-content">
    <p class="text-center mb-4">ငွေဖြည့်လိုပါက</p>
    <p>၁။ "ငွေဖြည့်" ကို နှိပ်ပါ။</p>
    <p>
      ၂။ KBZ Pay, Wave Pay, CB Pay နှင့် AYA Pay တို့မှ မိမိငွေဖြည့်မည့်
      ဘဏ်ကို ရွေးပါ။
    </p>
    <p>
      ၃။ သက်ဆိုင်ရာ Pay ဖြင့် ငွေသွင်းနိုင်သော အကောင့်များ
      ပေါ်လာပါလိမ့်မည်။
    </p>
  </div>
</div>
<!-- wallet info end -->

@include('user_layout.footer')

@endsection