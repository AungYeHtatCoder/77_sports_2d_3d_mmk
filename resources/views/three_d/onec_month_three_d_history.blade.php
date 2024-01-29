@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div style="
          padding: 80px 0 0px 0;
          font-family: 'Noto Sans Myanmar', sans-serif;
        ">
  <!-- content section start -->
  <p class="text-center" style="font-size: 20px; color: var(--Font-Body, #5a5a5a)">
    တစ်လအတွင်း 3D ထိုးမှတ်တမ်း
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
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
       
        @if($displayThreeDigits)
        @foreach ($displayThreeDigits['three_digits'] as $index => $digit)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $digit->three_digit }}</td>
          <td>{{ $digit->pivot->sub_amount }}</td>
          {{-- date with format --}}
          <td>{{ date('d-m-Y', strtotime($digit->pivot->created_at)) }}</td>
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