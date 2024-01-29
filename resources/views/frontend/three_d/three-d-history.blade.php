@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div style="
          padding: 80px 0 0px 0;
          font-family: 'Noto Sans Myanmar', sans-serif;
        ">
  <!-- content section start -->
  <p class="text-center" style="font-size: 20px; color: var(--Font-Body, #5a5a5a)">
    တစ်ပတ်အတွင်း 3D ထိုးမှတ်တမ်း
  </p>



  <div class="nine-thirty py-1">
    {{-- <p class="text-center text-dark">တစ်ပတ်အတွင်း 3D ထိုးမှတ်တမ်း</p> --}}
    <div class="card mt-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div class="card-header mt-3">
        <p class="text-center text-white">
          <script>
            var d = new Date();
            document.write(d.toLocaleDateString());
          </script>
          <br />
          <script>
            var d = new Date();
            document.write(d.toLocaleTimeString());
          </script>
        </p>
      </div>
    </div>
    <table class="table text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>3D</th>
          <th>ထိုးကြေး</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($displayThreeDigits['threeDigit']) && count($displayThreeDigits['threeDigit']) == 0)
        <p class="text-center text-white px-3 py-2 mt-3" style="background-color: #c50408">
          ကံစမ်းထားသော 3D ထီဂဏန်းများ မရှိသေးပါ
          <span>
            <a href="{{ url('/user/three-d-choice-play-index')}}" style="color: #f5bd02; text-decoration:none">
              <strong>ထီးထိုးရန် နိုပ်ပါ</strong></a>
          </span>
        </p>
        @endif

        @if($displayThreeDigits)
        @foreach ($displayThreeDigits['threeDigit'] as $index => $digit)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $digit->three_digit }}</td>
          <td>{{ $digit->pivot->sub_amount }}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    <div class="mb-3 d-flex justify-content-around text-white p-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p class="text-end pt-1" style="color: #fff">Total Amount for 3D: ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
        <strong>{{ $displayThreeDigits['total_amount'] }} MMK</strong>
      </p>
    </div>
  </div>




  {{-- <div id="first_tab" class="tabcontent mt-4" style="display: none; min-height: 100vh">
    <div>
      <p class="text-center" style="font-size: 14px; color: var(--Font-Body, #5a5a5a)">
        Morning Session
      </p>
      <div class="d-flex justify-content-around align-items-center text-center m-3 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
        <div>
          <p style="font-size: 16px; color: #dde3f0">Session</p>
          <p style="font-size: 14px; color: #abb1cc">Evening</p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">Date</p>
          <p style="font-size: 14px; color: #abb1cc">
            10-11-2023 Friday 04:07 PM
          </p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">2D</p>
          <p style="font-size: 14px; color: #ff1267">83</p>
        </div>
      </div>

      <div class="d-flex justify-content-around align-items-center text-center m-3 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
        <div>
          <p style="font-size: 16px; color: #dde3f0">Session</p>
          <p style="font-size: 14px; color: #abb1cc">Evening</p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">Date</p>
          <p style="font-size: 14px; color: #abb1cc">
            10-11-2023 Friday 04:07 PM
          </p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">2D</p>
          <p style="font-size: 14px; color: #ff1267">83</p>
        </div>
      </div>

      <div class="d-flex justify-content-around align-items-center text-center m-3 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
        <div>
          <p style="font-size: 16px; color: #dde3f0">Session</p>
          <p style="font-size: 14px; color: #abb1cc">Evening</p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">Date</p>
          <p style="font-size: 14px; color: #abb1cc">
            10-11-2023 Friday 04:07 PM
          </p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">2D</p>
          <p style="font-size: 14px; color: #ff1267">83</p>
        </div>
      </div>

      <div class="d-flex justify-content-around align-items-center text-center m-3 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
        <div>
          <p style="font-size: 16px; color: #dde3f0">Session</p>
          <p style="font-size: 14px; color: #abb1cc">Evening</p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">Date</p>
          <p style="font-size: 14px; color: #abb1cc">
            10-11-2023 Friday 04:07 PM
          </p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">2D</p>
          <p style="font-size: 14px; color: #ff1267">83</p>
        </div>
      </div>
    </div>
  </div>

  <div id="second_tab" class="tabcontent mt-4" style="display: block; min-height: 100vh">
    <p class="text-center" style="font-size: 14px; color: var(--Font-Body, #5a5a5a)">
      Evening Session
    </p>
    <div>
      <div class="d-flex justify-content-around align-items-center text-center m-3 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
        <div>
          <p style="font-size: 16px; color: #dde3f0">Session</p>
          <p style="font-size: 14px; color: #abb1cc">Evening</p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">Date</p>
          <p style="font-size: 14px; color: #abb1cc">
            10-11-2023 Friday 04:07 PM
          </p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">2D</p>
          <p style="font-size: 14px; color: #ff1267">83</p>
        </div>
      </div>

      <div class="d-flex justify-content-around align-items-center text-center m-3 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
        <div>
          <p style="font-size: 16px; color: #dde3f0">Session</p>
          <p style="font-size: 14px; color: #abb1cc">Evening</p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">Date</p>
          <p style="font-size: 14px; color: #abb1cc">
            10-11-2023 Friday 04:07 PM
          </p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">2D</p>
          <p style="font-size: 14px; color: #ff1267">83</p>
        </div>
      </div>

      <div class="d-flex justify-content-around align-items-center text-center m-3 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
        <div>
          <p style="font-size: 16px; color: #dde3f0">Session</p>
          <p style="font-size: 14px; color: #abb1cc">Evening</p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">Date</p>
          <p style="font-size: 14px; color: #abb1cc">
            10-11-2023 Friday 04:07 PM
          </p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">2D</p>
          <p style="font-size: 14px; color: #ff1267">83</p>
        </div>
      </div>

      <div class="d-flex justify-content-around align-items-center text-center m-3 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
        <div>
          <p style="font-size: 16px; color: #dde3f0">Session</p>
          <p style="font-size: 14px; color: #abb1cc">Evening</p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">Date</p>
          <p style="font-size: 14px; color: #abb1cc">
            10-11-2023 Friday 04:07 PM
          </p>
        </div>
        <div>
          <p style="font-size: 16px; color: #dde3f0">2D</p>
          <p style="font-size: 14px; color: #ff1267">83</p>
        </div>
      </div>
    </div>
  </div> --}}

  <!-- content section end -->
</div>

@include('user_layout.footer')
@endsection

@section('script')
<script>
  function openTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName('tabcontent');
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = 'none';
    }
    tablinks = document.getElementsByClassName('tablinks');
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(' active', '');
    }
    document.getElementById(cityName).style.display = 'block';
    evt.currentTarget.className += ' active';
  }
</script>

<script>
  $(document).ready(function() {
    $("#profile").click(function() {
      $(".profile").removeClass('d-none');
      $(".nine-thirty").addClass('d-none');
      $(".twelve").addClass('d-none');
      $(".two").addClass('d-none');
      $(".four-thirty").addClass('d-none');

      $('#profile').addClass('click');
      $('#nine-thirty').removeClass('click');
      $('#twelve').removeClass('click');
      $('#two').removeClass('click');
      $('#four-thirty').removeClass('click');
    })
    $("#nine-thirty").click(function() {
      $(".profile").addClass('d-none');
      $(".nine-thirty").removeClass('d-none');
      $(".twelve").addClass('d-none');
      $(".two").addClass('d-none');
      $(".four-thirty").addClass('d-none');

      $('#profile').removeClass('click');
      $('#nine-thirty').addClass('click');
      $('#twelve').removeClass('click');
      $('#two').removeClass('click');
      $('#four-thirty').removeClass('click');
    })
    $("#twelve").click(function() {
      $(".profile").addClass('d-none');
      $(".nine-thirty").addClass('d-none');
      $(".twelve").removeClass('d-none');
      $(".two").addClass('d-none');
      $(".four-thirty").addClass('d-none');

      $('#profile').removeClass('click');
      $('#nine-thirty').removeClass('click');
      $('#twelve').addClass('click');
      $('#two').removeClass('click');
      $('#four-thirty').removeClass('click');
    })
    $("#two").click(function() {
      $(".profile").addClass('d-none');
      $(".nine-thirty").addClass('d-none');
      $(".twelve").addClass('d-none');
      $(".two").removeClass('d-none');
      $(".four-thirty").addClass('d-none');

      $('#profile').removeClass('click');
      $('#nine-thirty').removeClass('click');
      $('#twelve').removeClass('click');
      $('#two').addClass('click');
      $('#four-thirty').removeClass('click');
    })
    $("#four-thirty").click(function() {
      $(".profile").addClass('d-none');
      $(".nine-thirty").addClass('d-none');
      $(".twelve").addClass('d-none');
      $(".two").addClass('d-none');
      $(".four-thirty").removeClass('d-none');

      $('#profile').removeClass('click');
      $('#nine-thirty').removeClass('click');
      $('#twelve').removeClass('click');
      $('#two').removeClass('click');
      $('#four-thirty').addClass('click');
    })
  })
</script>
@endsection