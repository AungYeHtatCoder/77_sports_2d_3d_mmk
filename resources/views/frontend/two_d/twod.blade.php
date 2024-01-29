@extends('user_layout.app')

@section('style')
<style>
  .multi-text {
    display: flex;
    justify-content: space-around;
    align-items: center;
  }
</style>
@endsection

@section('content')
@include('user_layout.nav')
<div class="d-flex justify-content-around align-items-center mx-auto" style="
          background-color: var(--default);
          width: 358px;
          height: 59px;
          border-radius: 24px;
          border: 2px solid var(--gold, #576265);
          background: #12486b;
          padding: 12px 16px;
          margin-top: 80px;
        ">
  <img src="{{ asset('user_app/assets/img/vector.png') }}" width="24px" height="24px" alt="" />
  <p class="pt-3" style="font-size: 16px; font-weight: 500">ပိုက်ဆံအိတ် </p>
  <p class="pt-3" style="
            font-size: 16px;
            font-weight: 700;
            font-family: 'Lato', sans-serif;
          ">
    {{ Auth::user()->balance }} Kyats
  </p>

  <img src="{{ asset('user_app/assets/img/plus.png') }}" class="rounded-circle" style="padding: 10px; color: var(--blue); background-color: #fff" alt="" />
</div>

<div class="d-flex justify-content-between align-items-center my-2 mx-auto" style="
          width: 358px;
          height: 90px;
          border: 1px solid #1c30e0;
          padding: 12px 16px;
          border-radius: 24px;
        ">
  <a href="{{ url('wallet/topUp-bank') }}">
    <div class="menus">
      <img src="{{ asset('user_app/assets/img/2D/money-withdrawal 1.png') }}" width="20px" height="20px" alt="" />
    </div>
    <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
      ငွေဖြည့်
    </p>
  </a>

  <a href="{{ url('wallet/withdraw-bank') }}">
    <div class="menus">
      <img src="{{ asset('user_app/assets/img/2D/send-money 1.png') }}" width="20px" height="20px" alt="" />
    </div>
    <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
      ငွေထုတ်
    </p>
  </a>

  <a href="{{ route('home') }}">
    <div class="menus">
      <img src="{{ asset('user_app/assets/img/2D/receipt.png') }}" width="20px" height="20px" alt="" />
    </div>
    <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
      မှတ်တမ်း
    </p>
  </a>
</div>
<!-- play section  start-->
<div class="p-3">
  <div class="twod_styles mx-auto">
    <h5 class="d-flex justify-content-center align-items-center" id="live_2d" style="font-size: 20px">
      83
    </h5>
  </div>
  <div class="text-center mt-1" style="color: #5a5a5a; font-size: 16px; line-height: 20px">
    Last Update: <span id="live_updated_time">30 Nov 2023 04:29:44 PM</span>
  </div>
  <div class="d-flex justify-content-center align-items-center mt-3" width="126px" height="45px">
    <button type="button" class="text-white" style="
              border-radius: 10px;
              background: var(--default);
              padding: 10px;
              border: none;
              font-size: 16px;
            " data-bs-toggle="modal" data-bs-target="#time_modal">
      ထိုးမည်
    </button>
  </div>
</div>
<!-- play section end -->

<!-- 2d lists -->
<div class="mx-auto lives" style="margin-bottom:80px;" id="result"></div>
<!-- 2d lists -->


@include('user_layout.footer')
<!-- time modal -->
<!-- Modal -->
<div class="modal fade" id="time_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="top: 30%">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title text-dark" id="exampleModalLongTitle" style="font-size: 15px">ထိုးမည့်အချိန် (section) ကိုရွေးပါ
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @php
        use Carbon\Carbon;
        $currentTime = Carbon::now();
        $start9Time = Carbon::parse('9:30');
        $end12Time = Carbon::parse('12:00');
        $start12Time = Carbon::parse('12:00');
        $end2Time = Carbon::parse('14:00');
        $start2Time = Carbon::parse('14:00');
        $end4Time = Carbon::parse('16:30');
        @endphp
        <button class="btn w-100 my-1" style="background: var(--linear)">
          @if ($currentTime->lte(Carbon::parse('09:30')))
          <a href="{{ route('user.twod-play-index-9am') }}">09:30 AM</a>
          @else
          <span class="w-100 border-purple py-2 rounded d-block text-purple text-center">09:30 AM</span>
          @endif
        </button>
        <button class="btn w-100 my-1" style="background: var(--linear)">
          @if ($currentTime->between($start9Time, $end12Time))
          <a href="{{ route('user.twod-play-index-9am') }}">12:00 PM</a>
          @else
          <span class="w-100 border-purple py-2 rounded d-block text-purple text-center">12:00 PM</span>
          @endif
        </button>
        <button class="btn w-100 my-1" style="background: var(--linear)">
          @if ($currentTime->between($start12Time, $end2Time))
          <a href="{{ route('user.twod-play-index-9am') }}">2:00 PM</a>
          @else
          <span class="w-100 border-purple py-2 rounded d-block text-purple text-center">02:00 PM</span>
          @endif
        </button>
        <button class="btn w-100 my-1" style="background: var(--linear)">
          {{-- @if ($currentTime->between($start2Time, $end4Time)) --}}
          <a href="{{ route('user.twod-play-index-9am') }}">4:00 PM</a>
          {{-- @else
          <span class="w-100 border-purple py-2 rounded d-block text-purple text-center">04:30 PM</span>
          @endif --}}
        </button>
      </div>
      <!-- <div class="modal-footer d-flex justify-content-center align-items-center">
            <button type="button" class="btn btn-primary px-5 py-2">ထိုးမည်</button>
            </div> -->
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  (function() {
    const fetchData = () => {
      const url = 'https://api.thaistock2d.com/live';

      fetch(url)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          const updatedTime = new Date(data.live.time);
          const day = updatedTime.getDate().toString().padStart(2, '0');
          const month = (updatedTime.getMonth() + 1).toString().padStart(2, '0');
          const year = updatedTime.getFullYear();
          let hours = updatedTime.getHours();
          const minutes = updatedTime.getMinutes();
          const ampm = hours >= 12 ? 'PM' : 'AM';
          hours = hours % 12;
          hours = hours ? hours : 12;
          const updatedTimeFormat = `${day}-${month}-${year} ${hours}:${minutes.toString().padStart(2, '0')}:${updatedTime.getSeconds().toString().padStart(2, '0')}${ampm}`;

          $("#live_2d").text(data.live.twod);
          $("#live_updated_time").text(updatedTimeFormat);

          let newHTML = '';
          data.result.forEach(r => {
            newHTML += `
                            <div class="digit-card mb-1 rounded-4 mb-2">
                              <h5 class="text-center">${r.open_time}</h5>
                              <div class="multi-text">
                                <div class="">
                                  <p>Set</p>
                                  <p>${r.set}</p>
                                </div>
                                <div class="">
                                  <p>Value</p>
                                  <p>${r.value}</p>
                                </div>
                                <div class="">
                                  <p>2D</p>
                                  <p>${r.twod}</p>
                                </div>
                              </div>
                          </div>
                          <hr />
                        `;
          });
          $('#result').html(newHTML);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    };

    setInterval(fetchData, 1000);
  })();
</script>
@endsection