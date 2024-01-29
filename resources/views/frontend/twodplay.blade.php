@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="d-flex justify-content-around align-items-center mx-auto profiles" style="
          background-color: var(--default);
          width: 358px;
          height: 59px;
          border-radius: 24px;
          border: 2px solid var(--gold, #576265);
          background: #12486b;
          padding: 12px 16px;
        ">
  <img src="{{ asset('user_app/assets/img/vector.png') }}" width="24px" height="24px" alt="" />
  <p style="font-size: 16px; font-weight: 500">ပိုက်ဆံအိတ်</p>
  <p style="
            font-size: 16px;
            font-weight: 700;
            font-family: 'Lato', sans-serif;
          ">
    12,670 Kyats
  </p>
  <img src="{{ asset('user_app/assets/img/plus.png') }}" class="rounded-circle" style="padding: 10px; color: var(--blue); background-color: #fff" alt="" />
</div>
<div class="my-3">
  <div class="d-flex justify-content-around align-items-center">
    <div class="d-flex justify-content-center align-items-center">
      <img src="{{ asset('user_app/assets/img/query_builder.png') }}" alt="" />
      <span class="mx-1" style="
                color: var(--Font-Body, #5a5a5a);
                font-family: Noto Sans Myanmar;
                font-size: 14px;
                font-style: normal;
                font-weight: 500;
              ">ပိတ်ရန်ကျန်ချိန်</span>
      <span class="mx-1" style="
                color: var(--Font-Heading, #232323);
                font-family: Poppins;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
              ">12:01 PM</span>
    </div>

    <select name="time_options" id="exampleSelect" class="px-3 py-1 rounded border border-none">
      <option value="12:00PM" selected>9:30AM</option>
      <option value="12:00PM">12:00PM</option>
      <option value="2:30AM">2:30AM</option>
      <option value="4:00PM">4:00PM</option>
    </select>
  </div>
</div>

<div class="d-flex justify-content-center align-items-center mt-3">
  <div class="quick-select mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <span>အမြန်ရွေးရန်</span>
  </div>

  <a href="#" type="button" class="d-flex justify-content-center align-items-center btn mx-2 px-3 py-2" style="
            border-radius: 26.471px;
            background: #78d6c6;
            box-shadow: 0px 0px 21.176px 0px rgba(240, 252, 172, 0.9);
          ">
    <img src="{{ asset('user_app/assets/img/2D/tabler_planet.png') }}" class="mx-2" alt="" />
    <span style="color: #12486b">အိမ်မက်ဂဏန်း</span>
  </a>
</div>

<div class="d-flex justify-content-center align-items-center mt-3" style="font-size: 16px">
  <form class="px-4" style="width: 100%">
    <input type="text " class="form-control" style="color: rgba(59, 54, 54, 0.35)" placeholder="ငွေပမာဏထည့်ပါ" />
    <button class="btn my-2" style="
              display: flex;
              width: 100%;
              height: 45px;
              padding: 10px;
              justify-content: center;
              align-items: center;
              gap: 10px;
              align-self: stretch;
              border-radius: 10px;
              background: #bbb;
            ">
      <span style="color: var(--Font-Heading, #232323)">ပတ်လည်ထိုးမည်</span>
    </button>
  </form>
</div>

<!-- number start -->
<div class="scrollable-div mt-4 mx-4" style="padding-bottom: 50px" style="font-size: 16px">
  <div class="d-flex justify-content-around align-items-center my-2">
    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>01</span>
      <div class="progress-bar1"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>02</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>03</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>04</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>05</span>
      <div class="progress-bar2"></div>
    </button>
  </div>

  <div class="d-flex justify-content-around align-items-center my-2">
    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>01</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>02</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>03</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>04</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>05</span>
      <div class="progress-bar2"></div>
    </button>
  </div>

  <div class="d-flex justify-content-around align-items-center my-2">
    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>01</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>02</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>03</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>04</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>05</span>
      <div class="progress-bar2"></div>
    </button>
  </div>

  <div class="d-flex justify-content-around align-items-center my-2">
    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>01</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>02</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>03</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>04</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>05</span>
      <div class="progress-bar2"></div>
    </button>
  </div>

  <div class="d-flex justify-content-around align-items-center my-2">
    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>01</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>02</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>03</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>04</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>05</span>
      <div class="progress-bar2"></div>
    </button>
  </div>
  <div class="d-flex justify-content-around align-items-center my-2">
    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>01</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>02</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>03</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>04</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>05</span>
      <div class="progress-bar2"></div>
    </button>
  </div>

  <div class="d-flex justify-content-around align-items-center my-2">
    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>01</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>02</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>03</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>04</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>05</span>
      <div class="progress-bar2"></div>
    </button>
  </div>

  <div class="d-flex justify-content-around align-items-center my-2">
    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>01</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>02</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>03</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>04</span>
      <div class="progress-bar2"></div>
    </button>

    <button class="d-flex justify-content-center align-items-center toggle-btn" data-toggle="false">
      <span>05</span>
      <div class="progress-bar2"></div>
    </button>
  </div>
</div>
<!-- number end -->

<!-- footer section start  -->
<footer class="fixed-bottom bg-white py-3 mx-auto">
  <div class="row">
    <div class="col">
      <a href="" style="
                display: flex;
                padding: 10px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 10px;
                border: 1px solid #fe0000;
                color: #fe0000;
              ">ဖျက်မည်</a>
    </div>
    <div class="col">
      <a href="{{ url('/twod-confirm') }}" style="
                display: flex;
                padding: 10px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 10px;
                background: var(--Primary, #12486b);
              ">ထိုးမည်</a>
    </div>
  </div>
</footer>
<!-- footer section end -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content py-4" style="background: var(--Scondary, #419197)">
      <button type="button" class="btn-close ms-auto py-2 px-4" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="mx-3">
        <div>
          <p class="modal-text">ဘရိတ်</p>
          <div class="modal-box">
            <div class="modal-digit">
              <span>0/10</span>
            </div>
            <div class="modal-digit">
              <span>1/11</span>
            </div>
            <div class="modal-digit">
              <span>2/12</span>
            </div>
            <div class="modal-digit">
              <span>3/13</span>
            </div>
            <div class="modal-digit">
              <span>4/14</span>
            </div>
          </div>
          <div class="modal-box my-2">
            <div class="modal-digit">
              <span>0/10</span>
            </div>
            <div class="modal-digit">
              <span>1/11</span>
            </div>
            <div class="modal-digit">
              <span>2/12</span>
            </div>
            <div class="modal-digit">
              <span>3/13</span>
            </div>
            <div class="modal-digit">
              <span>4/14</span>
            </div>
          </div>
        </div>
        <div>
          <p class="modal-text">Single & Double Size</p>
          <div class="modal-box">
            <div class="modal-digit">
              <span>ညီကို</span>
            </div>
            <div class="modal-digit">
              <span>ကြီး</span>
            </div>
            <div class="modal-digit">
              <span>ငယ်</span>
            </div>
            <div class="modal-digit">
              <span>မ</span>
            </div>
            <div class="modal-digit">
              <span>စုံ</span>
            </div>
          </div>
          <div class="modal-box my-2">
            <div class="modal-digit">
              <span>စုံစုံ</span>
            </div>
            <div class="modal-digit">
              <span>စုံမ</span>
            </div>
            <div class="modal-digit">
              <span>မစုံ</span>
            </div>
            <div class="modal-digit">
              <span>မမ</span>
            </div>
            <div class="modal-digit">
              <span>အပူး</span>
            </div>
          </div>
        </div>
        <div>
          <p class="modal-text">ပတ်သီး</p>
          <div class="modal-box">
            <div class="modal-digit">
              <span>0</span>
            </div>
            <div class="modal-digit">
              <span>1</span>
            </div>
            <div class="modal-digit">
              <span>2</span>
            </div>
            <div class="modal-digit">
              <span>3</span>
            </div>
            <div class="modal-digit">
              <span>4</span>
            </div>
          </div>
          <div class="modal-box my-2">
            <div class="modal-digit">
              <span>5</span>
            </div>
            <div class="modal-digit">
              <span>6</span>
            </div>
            <div class="modal-digit">
              <span>7</span>
            </div>
            <div class="modal-digit">
              <span>8</span>
            </div>
            <div class="modal-digit">
              <span>9</span>
            </div>
          </div>
        </div>
        <div>
          <p class="modal-text">ထိပ်</p>
          <div class="modal-box">
            <div class="modal-digit">
              <span>0</span>
            </div>
            <div class="modal-digit">
              <span>1</span>
            </div>
            <div class="modal-digit">
              <span>2</span>
            </div>
            <div class="modal-digit">
              <span>3</span>
            </div>
            <div class="modal-digit">
              <span>4</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection