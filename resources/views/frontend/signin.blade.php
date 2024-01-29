@extends('user_layout.app')

@section('content')
<div class="main-body" style="margin-bottom: 0;padding-bottom: 0;height: 100vh;">

  <!-- <div class="d-flex justify-content-center align-items-center">
  <img src="{{ asset('user_app/assets/img/image 3 (1).png') }}" class="mb-5" style="border-radius: 50%;" alt="">
 </div> -->

  <div style="background: linear-gradient(#C6ECEA, #2BC0E4);padding-top:30px; padding-bottom: 80px;border-top-left-radius: 59px;border-top-right-radius: 59px;">
    <div class="text-center">
      <h6 class="login-titles">Welcome Back!</h6>
      <span style="color: #5A5A5A;font-size: 14px;font-weight: 500;">welcome back we missed you</span>
    </div>

    <form action="">

      <span class="text-start mx-2" style="color: #A4A4A4;font-family: 'Noto Sans',sans-serif;font-size: 14px;">ဖုန်းနံပါတ်</span>
      <div class="d-flex justify-content-start align-items-center my-3">
        <div class="dropdown mx-2">
          <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
            <img src="{{ asset('user_app/assets/img/2D/flag.png') }}" alt="">
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">
                <img src="{{ asset('user_app/assets/img/2D/thai-flag.png') }}" style="width: 24px;height: 24px;" alt="">
                Thailand
              </a></li>
            <li><a class="dropdown-item" href="#">
                <img src="{{ asset('user_app/assets/img/2D/china-flag.png') }}" style="width: 24px;height: 24px;" alt="">
                China
              </a></li>
          </ul>
        </div>

        <div class="mx-2" style="position: relative;">
          <img src="{{ asset('user_app/assets/img/2D/fi-br-call-history.png') }}" style="position: absolute;top: 5px;left: 10px;" alt="">
          <input type="text" class="ps-5 py-2 rounded" style="outline: none;border: 1px solid #ddd;" placeholder="09123456789">
        </div>
      </div>

      <div>
        <span class="text-start mx-2" style="color: #A4A4A4;font-family: 'Noto Sans',sans-serif;font-size: 14px;">လျှိ၀ှက်နံပါတ်</span>

        <div class="m-2" style="position: relative;">
          <img src="{{ asset('user_app/assets/img/2D/Vector (1).png') }}" style="position: absolute;top: 5px;left: 10px;" alt="">
          <input type="password" class="ps-5 py-2 rounded w-100" style="outline: none;border: 1px solid #ddd;" placeholder="******">
        </div>
      </div>

      <div class="d-flex justify-content-center align-items-center">
        <button type="button" class="w-100 mx-2 mt-5 py-2 rounded text-white border border-none" style="background: var(--linear);font-size: 18px;">အကောင့်အသစ်ဖွင့်မည် </button>
      </div>

      <div class="text-center mt-3" style="font-size: 12px;font-weight: 500;">
        <span style="color: #5A5A5A;">အကောင့်ရှိပီးသားလား? <a href="login.html" class="fw-bold" style="color: #232323;">အကောင့်၀င်ပါ</a></span>
      </div>

    </form>
  </div>

</div>
@endsection