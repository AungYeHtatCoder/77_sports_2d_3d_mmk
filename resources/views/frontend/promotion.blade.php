@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
@include('user_layout.profile')


<div style="padding-bottom: 50px" style="font-family: 'Poppins', sans-serif">
 <!-- content section start -->
 @foreach ($promotions as $promo)
 <a href="{{ url('/promotion/promoDetail/'.$promo->id) }}" class="d-flex justify-content-around align-items-center promo-styles my-2 mx-3 p-3">
    <img src="{{ $promo->img_url }}" width="100px" height="100px" class="rounded" alt="" />
    <div class="mx-4">
     <p style="font-size: 16px; color: var(--Text-Heading, #dde3f0)">
      {{ $promo->title }}
     </p>
     <p style="font-size: 14px; color: var(--Text-Body, #abb1cc)">
      Read More ....
     </p>
    </div>
    <i class="fa-solid fa-chevron-right"></i>
    </a>
 @endforeach


 {{-- <a href="{{ url('/promoDetail') }}" class="d-flex justify-content-around align-items-start promo-styles my-2 mx-3 p-3">
  <img src="{{ asset('user_app/assets/img/promo/IMG (2).png') }}" class="rounded" alt="" />
  <div class="mx-4">
   <p style="font-size: 16px; color: var(--Text-Heading, #dde3f0)">
    Title goes here
   </p>
   <p style="font-size: 14px; color: var(--Text-Body, #abb1cc)">
    It if sometimes furnished unwilling as additions so....
   </p>
  </div>
  <i class="fa-solid fa-chevron-right"></i>
 </a>

 <a href="{{ url('/promoDetail') }}" class="d-flex justify-content-around align-items-start promo-styles my-2 mx-3 p-3">
  <img src="{{ asset('user_app/assets/img/promo/IMG (3).png') }}" class="rounded" alt="" />
  <div class="mx-4">
   <p style="font-size: 16px; color: var(--Text-Heading, #dde3f0)">
    Title goes here
   </p>
   <p style="font-size: 14px; color: var(--Text-Body, #abb1cc)">
    It if sometimes furnished unwilling as additions so....
   </p>
  </div>
  <i class="fa-solid fa-chevron-right"></i>
 </a>

 <a href="{{ url('/promoDetail') }}" class="d-flex justify-content-around align-items-start promo-styles my-2 mx-3 p-3">
  <img src="{{ asset('user_app/assets/img/promo/IMG (4).png') }}" class="rounded" alt="" />
  <div class="mx-4">
   <p style="font-size: 16px; color: var(--Text-Heading, #dde3f0)">
    Title goes here
   </p>
   <p style="font-size: 14px; color: var(--Text-Body, #abb1cc)">
    It if sometimes furnished unwilling as additions so....
   </p>
  </div>
  <i class="fa-solid fa-chevron-right"></i>
 </a>
 <a href="{{ url('/promoDetail') }}" class="d-flex justify-content-around align-items-start promo-styles my-2 mx-3 p-3">
  <img src="{{ asset('user_app/assets/img/promo/IMG.png') }}" class="rounded" alt="" />
  <div class="mx-4">
   <p style="font-size: 16px; color: var(--Text-Heading, #dde3f0)">
    Title goes here
   </p>
   <p style="font-size: 14px; color: var(--Text-Body, #abb1cc)">
    It if sometimes furnished unwilling as additions so....
   </p>
  </div>
  <i class="fa-solid fa-chevron-right"></i>
 </a> --}}

 <!-- content section end -->
</div>

@include('user_layout.footer')
@endsection