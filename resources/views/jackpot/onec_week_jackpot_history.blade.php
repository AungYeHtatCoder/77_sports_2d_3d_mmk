@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div style="
          padding: 80px 0 0px 0;
          font-family: 'Noto Sans Myanmar', sans-serif;
        ">
  <!-- content section start -->
  <p class="text-center" style="font-size: 20px; color: var(--Font-Body, #5a5a5a)">
    တစ်ပတ်အတွင်း အောက်နှစ်လုံး ထိုးမှတ်တမ်း
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
          <th>အောက်နှစ်လုံး</th>
          <th>ထိုးကြေး</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($displayThreeDigits['jackpotDigit']) && count($displayThreeDigits['jackpotDigit']) == 0)
        <p class="text-center text-white px-3 py-2 mt-3" style="background-color: #c50408">
          ကံစမ်းထားသော အောက်နှစ်လုံး ထီဂဏန်းများ မရှိသေးပါ
          <span>
            <a href="{{ url('/user/jackport-play')}}" style="color: #f5bd02; text-decoration:none">
              <strong>ထီးထိုးရန် နိုပ်ပါ</strong></a>
          </span>
        </p>
        @endif

        @if($displayThreeDigits)
        @foreach ($displayThreeDigits['jackpotDigit'] as $index => $digit)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $digit->two_digit }}</td>
          <td>{{ $digit->pivot->sub_amount }}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    <div class="mb-3 d-flex justify-content-around text-white p-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p class="text-end pt-1" style="color: #fff">Total Amount : ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
        <strong>{{ $displayThreeDigits['total_amount'] }} MMK</strong>
      </p>
    </div>
  </div>
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