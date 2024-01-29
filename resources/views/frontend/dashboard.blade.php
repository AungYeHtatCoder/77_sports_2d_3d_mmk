@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
@include('user_layout.profile')
<!-- content section start -->
<div class="my-2" style="font-family: 'Noto Sans Myanmar', sans-serif; font-size: 16px">
  <div class="my-2 px-3 py-2" style="background:  #419197">
    <p style="
                font-family: 'Poppins', sans-serif;
                font-size: 12px;
                text-transform: uppercase;
                line-height: 16px;
                color: #12486b;
              ">
      Account
    </p>

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_0.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ route('user-profile-home') }}">
        <p>ကိုယ်ရေးအချက်အလက် (Profile)</p>
      </a>
    </div>
    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_1.png') }}" class="mt-1 me-3" alt="" />

      <a href="{{ route('user.twodHistory') }}">

        <p>2D ထီထိုးမှတ်တမ်း</p>
      </a>
    </div>
    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_1.png') }}" class="mt-1 me-3" alt="" />

      <a href="{{ route('user.two-d-once-month-play-history') }}">

        <p>2D တလအတွင်းမှတ်တမ်း</p>
      </a>
    </div>
    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />
    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_1.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ route('user.display') }}">
        <p>3D ထီထိုးမှတ်တမ်း</p>
      </a> 
    </div>
     <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_1.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('/user/three-d-once-month-play-history') }}">
        <p> တစ်လအတွင်း 3D ထီထိုးမှတ်တမ်း</p>
    </div>
    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_1.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('user/jackport-play-history') }}">
        <p>အောက်နှစ်လုံး ထီထိုးမှတ်တမ်း</p>
      </a>
    </div>
     <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_1.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('user/jackport-once-month-play-history') }}">
        <p>တလအတွင်းအောက်နှစ်လုံးမှတ်တမ်း</p>
      </a>
    </div>
  </div>

  <div class="my-2 px-3 py-2" style="background: var(--Scondary, #419197)">
    <p style="
                font-family: 'Poppins', sans-serif;
                font-size: 12px;
                text-transform: uppercase;
                line-height: 16px;
                color: #1d2766;
              ">
      Other Information
    </p>

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_2.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ route('user.winnerHistory') }}">
        <p>2D ကံထူးရှင်များ</p>
      </a>
    </div>

    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_3.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('/dashboard/twod-winDigitRecord') }}">
        <p>2D ထွက်ဂဏန်းများ</p>
      </a>
    </div>
    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_2.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('/user/three-d-winners-history') }}">
        <p>3D ကံထူးရှင်များ</p>
      </a>
    </div>

    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_3.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('/dashboard/threed-live') }}">
        <p>3D ထွက်ဂဏန်းများ</p>
      </a>
    </div>

    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_4.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('/dashboard/twod-live') }}">
        <p>2D Live</p>
      </a>
    </div>
    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_5.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('/dashboard/twod-calendar') }}">
        <p>2D Calendar</p>
      </a>
    </div>
    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_6.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('/dashboard/twod-holiday') }}">
        <p>2D Holidays</p>
      </a>
    </div>
    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />

    <!-- <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_7.png') }}" class="mt-1 me-3" alt="" />
      <a href="{{ url('/dashboard/threed-live') }}">
        <p>3D Live</p>
      </a>
    </div> -->
    <!-- <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " /> -->

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/language 1.png') }}" class="me-3" alt="" />
      <a href="#">
        <p>App version</p>
      </a>
    </div>
    <hr class="mt-0 ms-4" style="
                border-bottom: 0.5px solid var(--Overlay, rgba(0, 0, 0, 0.15));
              " />

    <div class="d-flex justify-content-start align-items-start">
      <img src="{{ asset('user_app/assets/img/icons/profile_8.png') }}" class="mt-1 me-3" alt="" />
      <a href="" onclick="event.preventDefault(); document.getElementById('logout').submit();">
        <p>အကောင့်မှ ထွက်ခွာရန်</p>
        <form action="{{ route('logout') }}" id="logout" class="d-none" method="POST">
          @csrf
        </form>
      </a>

    </div>
  </div>
</div>

<!-- content section end -->
@include('user_layout.footer')

@endsection