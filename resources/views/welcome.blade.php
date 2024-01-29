@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<!-- profile section start -->
@include('user_layout.profile')
<!-- profile section end -->

@auth
  <!-- kyat-baht -->
  <div class="my-2 d-flex justify-content-around align-items-center">
    @if(Auth::user()->user_currency == 'MMK')
    <div class="money currency-active" id="mmk">Kyat / ကျပ်</div>
    <img src="{{ asset('user_app/assets/img/arrow.png') }}" width="32px" height="32px" alt="" />
    @else
    <div class="money" id="bht">Baht / ဘတ်</div>
    @endif
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
      @if(Auth::user()->user_currency == 'mmk')
      {{ number_format(Auth::user()->balance) }} MMK
      @endif
      {{-- {{ number_format(Auth::user()->balance * $rate) }} MMK --}}
      {{-- {{ number_format(Auth::user()->balance) }} Kyats --}}
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
      @if(Auth::user()->user_currency == 'bath')
      {{ number_format(Auth::user()->balance / $rate) }} Bahts
      @endif
      {{-- {{ number_format(Auth::user()->balance / $rate) }} Bahts --}}
    </p>

    <img src="{{ asset('user_app/assets/img/plus.png') }}" class="rounded-circle" style="padding: 10px; color: var(--blue); background-color: #fff" alt="" />
  </div>
@endauth

<!-- carousel -->
<div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade px-3 pt-2" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach ($banners as $key => $banner)
    <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
      <img src="{{ asset('assets/img/banners/'.$banner->image) }}" style="max-height: 500px" class="d-block w-100" alt="..." />

      <div class="marquee">
        <div class="marquee-text">
          {{ $marqueeText->text }}
        </div>
      </div>

    </div>
    @endforeach

  </div>
</div>
<!-- carousel -->

<!-- button section start-->
<div class="d-flex justify-content-around align-items-center" style="padding-top: 16px">
  <div>
    <a href="{{ route('user.twod-play-index') }}" class="btns">2Dထိုးမည်</a>
    <p class="d-block mt-2 text-center" style="font-size: 14px; font-weight: 700; color: var(--default)">
      ၂လုံးထီ
    </p>
  </div>
  <div>
    <a href="{{ route('user.three-d-choice-play') }}" class="btns">3Dထိုးမည်</a>
    <p class="d-block mt-2 text-center" style="font-size: 14px; font-weight: 700; color: var(--default)">
      ၃လုံးထီ
    </p>
  </div>
  
</div>

<div class="d-flex justify-content-around align-items-center" style="padding-top: 16px">
  <div>
    <a href="{{ route('user.jackport-play') }}" class="btns">အောက်နှစ်လုံးထီ</a>
    <p class="d-block mt-2 text-center" style="font-size: 14px; font-weight: 700; color: var(--default)">
      အောက်နှစ်လုံးထီ
    </p>
  </div>
</div>

<div class="row my-3 mx-2">

  @foreach ($games as $game)
  <div class="col-6 mb-4">
    <a href="{{ $game->link }}" target="__blank" class="text-decoration-none">
      <img src="{{ $game->img_url }}" width="100%" class="rounded-4" alt="">
      <span class="d-block text-center mt-2" style="font-size: 14px; font-weight: 700; color: var(--default)">{{ $game->name }}</span>
    </a>
  </div>
  @endforeach

</div>

<!-- <div class="d-flex justify-content-around align-items-center" style="margin-top: 16px">
  @foreach($games as $game)
  <img src="{{ asset('user_app/assets/img/logo1.png') }}" class="w-100" style="border-radius: 16px" alt="" />
  <img src="{{ asset('user_app/assets/img/logo2.png') }}" class="w-100" style="border-radius: 16px" alt="" />
  @endforeach
</div> -->
<!-- button section end-->
@include('user_layout.footer')

@endsection