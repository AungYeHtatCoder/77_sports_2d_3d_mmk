<div class="container-fluid profiles">
  <div class="d-flex justify-content-between align-items-center">
    <div class="d-flex">
      @guest
      <img src="{{ asset('user_app/assets/img/Group.png') }}" class="rounded-circle mt-1" style="
                padding: 10px;
                background-color: #f6ffc3;
                color: var(--green);
                margin-right: 16px;
              " alt="" />
      <div class="pt-2"><a href="{{ route('login') }}" style="font-size: 16px; font-weight: 700; color: var(--default)">အကောင့်ဝင်ပါ</a></div>
      @endguest
      @auth
      @if(Auth::user()->profile)
      <img src="{{ Auth::user()->img_url }}" width="50px" height="50px" class="rounded-circle mt-1" style="
                padding: 10px;
                background-color: #f6ffc3;
                color: var(--green);
                margin-right: 16px;
              " alt="" />
      @else
      <img src="{{ asset('user_app/assets/img/Group.png') }}" class="rounded-circle mt-1" style="
                padding: 10px;
                background-color: #f6ffc3;
                color: var(--green);
                margin-right: 16px;
              " alt="" />
      @endif

      <div>
        <span class="d-block py-0 my-0" style="font-size: 16px; color: var(--default); font-weight: 600">{{ Auth::user()->name }}</span>
        <span class="d-block py-0 my-0" style="font-size: 14px; color: var(--default); font-weight: 400">{{ Auth::user()->phone }}</span>
      </div>
      @endauth
    </div>
    <div class="">
      <img src="{{ asset('user_app/assets/img/myanmar.png') }}" width="24px" height="24px" style="margin-right: 16px" alt="" />
      @auth
      <img src="{{ asset('user_app/assets/img/bell.png') }}" width="24px" height="24px" alt="" />
      @endauth
    </div>

  </div>
</div>