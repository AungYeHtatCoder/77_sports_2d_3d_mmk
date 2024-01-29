@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div style="
          font-size: 16px;
          font-family: 'Noto Sans Myanmar', sans-serif;
          padding: 70px 0 10px 0;
          min-height: 100vh;
        ">
 <img src="{{ $promotion->img_url }}" class="w-100" alt="" />
 <div class="promotion">
  <h4 class="text-center pt-3 text-dark">
   "{{ $promotion->title }}"
  </h4>
  <div class="px-3">
   <p class="-d-flex justify-content-center align-items-center">
    {!! $promotion->description !!}
   </p>
   <p class="text-dark pb-4">
    🔺ပရိုမိုးရှင်းအသေးစိတ်သိရန်....PageMessenger or Viber ph number-
    09 983 880 968 , 09 973 530 306 🌐 Thai 2D3D website-
    https://thailotto123.net
   </p>
  </div>
 </div>
</div>

@include('user_layout.footer')
@endsection