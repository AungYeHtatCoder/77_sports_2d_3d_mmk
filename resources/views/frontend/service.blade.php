@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
@include('user_layout.profile')
<div class="container-fluid mt-2">
 <!-- content section start -->
 <div style="
            color: var(--Font-Body, #5a5a5a);
            text-align: center;
            font-family: Noto Sans Myanmar;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
          ">
  <p class="text-center">ကျွန်ုပ်တို့ကို ဆက်သွယ်ရန်</p>
  <p>အောက်ပါတို့သည် <b style="font-family:Arial, Helvetica, sans-serif">ThaiLotto</b> တရားဝင်ဖုန်းနံပါတ် များဖြစ်ပါသည်။</p>
 </div>
 <div class="d-flex justify-content-between align-items-center m-2" style="border-radius: 10px; padding: 8px 16px 8px 16px">
  <p class="ms-3 mt-1" style="font-size: 14px; font-weight: 400; color: #000">
   ငွေဖြည့် /ငွေထုတ်
  </p>
  <div>
   <img src="{{ asset('user_app/assets/img/telegram.png') }}" class="mx-1" width="24px" height="24px" alt="" />
   <img src="{{ asset('user_app/assets/img/viber.png') }}" class="mx-1" width="24px" height="24px" alt="" />
   <img src="{{ asset('user_app/assets/img/line.png') }}" class="mx-1" width="24px" height="24px" alt="" />
   <img src="{{ asset('user_app/assets/img/Facebook.png') }}" class="mx-1" width="24px" height="24px" alt="" />
  </div>
 </div>

 <div class="d-flex justify-content-between align-items-center m-2" style="border-radius: 10px; padding: 8px 16px 8px 16px">
  <p class="ms-3 mt-1" style="font-size: 14px; font-weight: 400; color: #000">
   ငွေဖြည့် /ငွေထုတ်
  </p>
  <div>
   <img src="{{ asset('user_app/assets/img/telegram.png') }}" class="mx-1" width="24px" height="24px" alt="" />
   <img src="{{ asset('user_app/assets/img/viber.png') }}" class="mx-1" width="24px" height="24px" alt="" />
   <img src="{{ asset('user_app/assets/img/line.png') }}" class="mx-1" width="24px" height="24px" alt="" />
   <img src="{{ asset('user_app/assets/img/Facebook.png') }}" class="mx-1" width="24px" height="24px" alt="" />
  </div>
 </div>

 <div class="d-flex justify-content-between align-items-center m-2" style="border-radius: 10px; padding: 8px 16px 8px 16px">
  <p class="ms-3 mt-1" style="font-size: 14px; font-weight: 400; color: #000">
   ငွေဖြည့် /ငွေထုတ်
  </p>
  <div>
   <img src="{{ asset('user_app/assets/img/telegram.png') }}" class="mx-1" width="24px" height="24px" alt="" />
   <img src="{{ asset('user_app/assets/img/viber.png') }}" class="mx-1" width="24px" height="24px" alt="" />
   <img src="{{ asset('user_app/assets/img/line.png') }}" class="mx-1" width="24px" height="24px" alt="" />
   <img src="{{ asset('user_app/assets/img/Facebook.png') }}" class="mx-1" width="24px" height="24px" alt="" />
  </div>
 </div>
 <!-- content section end -->
</div>
@include('user_layout.footer')

@endsection