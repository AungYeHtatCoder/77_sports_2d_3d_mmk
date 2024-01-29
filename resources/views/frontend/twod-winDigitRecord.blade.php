@extends('user_layout.app')

@section('content')
@include('user_layout.nav')

<!-- content section start -->
<div class="mt-5 pt-4" style="padding-bottom: 100px;">
 <small class="text-center fs-5 fw-bold text-dark mt-3 d-block mb-3">နောက်ဆုံး ထွက်ဂဏန်းများ</small>
 <div class="d-flex justify-content-between">
  <button class="btn w-100 py-3 active" style="border-radius: 10px; background: var(--Primary, #12486b)" id="morning">
   <i class="fas fa-clock fs-3 d-block mb-2"></i>
   <small class="fs-5">မနက်ပိုင်း</small>
  </button>
  <button class="btn w-100 py-3" style="border-radius: 10px; background: var(--Primary, #12486b)" id="evening">
   <i class="fas fa-clock fs-3 d-block mb-2"></i>
   <small class="fs-5">ညနေပိုင်း</small>
  </button>
 </div>
 <div class="morning my-3 text-center">
  <div class="box-color rounded-4 p-3 mb-3">
   <div class="row">
    <div class="col-3">
     <span class="d-block">Session</span>
     <span>09:30AM</span>
    </div>
    <div class="col-6">
     <span class="d-block">Date</span>
     <span class="latestDate"></span>
    </div>
    <div class="col-3">
     <span class="d-block">Internet 2D</span>
     <span id="morning9amInternet" class="text-warning"></span>
    </div>
   </div>
  </div>
  <div class="box-color rounded-4 p-3 mb-3">
   <div class="row">
    <div class="col-3">
     <span class="d-block">Session</span>
     <span>09:30AM</span>
    </div>
    <div class="col-6">
     <span class="d-block">Date</span>
     <span class="latestDate"></span>
    </div>
    <div class="col-3">
     <span class="d-block">Modern 2D</span>
     <span id="morning9amModern" class="text-warning"></span>
    </div>
   </div>
  </div>
 </div>
 <div class="evening my-3 text-center">
  <div class="box-color rounded-4 p-3 mb-3">
   <div class="row">
    <div class="col-3">
     <span class="d-block">Session</span>
     <span>12:00PM</span>
    </div>
    <div class="col-6">
     <span class="d-block">Date</span>
     <span class="latestDate"></span>
    </div>
    <div class="col-3">
     <span class="d-block">2D</span>
     <span id="evening12pm2D" class="text-warning"></span>
    </div>
   </div>
  </div>
  <div class="box-color rounded-4 p-3 mb-3">
   <div class="row">
    <div class="col-3">
     <span class="d-block">Session</span>
     <span>02:30PM</span>
    </div>
    <div class="col-6">
     <span class="d-block">Date</span>
     <span class="latestDate"></span>
    </div>
    <div class="col-3">
     <span class="d-block">Internet 2D</span>
     <span id="evening2pmInternet" class="text-warning"></span>
    </div>
   </div>
  </div>
  <div class="box-color rounded-4 p-3 mb-3">
   <div class="row">
    <div class="col-3">
     <span class="d-block">Session</span>
     <span>02:30PM</span>
    </div>
    <div class="col-6">
     <span class="d-block">Date</span>
     <span class="latestDate"></span>
    </div>
    <div class="col-3">
     <span class="d-block">Modern 2D</span>
     <span id="evening2pmModern" class="text-warning"></span>
    </div>
   </div>
  </div>
  <div class="box-color rounded-4 p-3 mb-3">
   <div class="row">
    <div class="col-3">
     <span class="d-block">Session</span>
     <span>04:00PM</span>
    </div>
    <div class="col-6">
     <span class="d-block">Date</span>
     <span class="latestDate"></span>
    </div>
    <div class="col-3">
     <span class="d-block">2D</span>
     <span id="evening4pm2D" class="text-warning"></span>
    </div>
   </div>
  </div>
 </div>
</div>

<!-- content section end -->

@include('user_layout.footer')
@endsection

@section('script')
<script>
 $(".evening").hide();

 $("#morning").click(function() {
  $(".morning").show();
  $(".evening").hide();
  $("#morning").addClass('active');
  $("#evening").removeClass('active');
 })
 $("#evening").click(function() {
  $(".morning").hide();
  $(".evening").show();
  $("#morning").removeClass('active');
  $("#evening").addClass('active');
 })
</script>
<script>
 async function fetchData() {
  const url = 'https://shwe-2d-live-api.p.rapidapi.com/calender';
  const options = {
   method: 'GET',
   headers: {
    'X-RapidAPI-Key': '53aaa0f305msh5cdcf7afaacaedcp11a2d2jsn2453bc4f2507',
    'X-RapidAPI-Host': 'shwe-2d-live-api.p.rapidapi.com'
   }
  };

  try {
   const response = await fetch(url, options);
   const result = await response.json(); // Parse the response as JSON
   const calendar = result.message;
   // console.log(calendar);
   let originalString = calendar[0].update;
   let dateString = originalString.split(':')[1].trim().split(' ')[0];
   let dateObj = new Date(dateString.replace(/(\d{2})\/(\w{3})\/(\d{4})/, '$2 $1, $3'));
   let formattedDate = dateObj.toISOString().split('T')[0];
   let days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
   let dayOfWeek = days[dateObj.getDay()];
   let updatedTime = `${dateString} (${dayOfWeek})`;

   $(".latestDate").text(updatedTime);
   $("#morning9amInternet").text(calendar[0].a9_internet)
   $("#morning9amModern").text(calendar[0].a9_modern)
   $("#evening12pm2D").text(calendar[0].a12_result)
   $("#evening2pmInternet").text(calendar[0].a2_internet)
   $("#evening2pmModern").text(calendar[0].a2_modern)
   $("#evening4pm2D").text(calendar[0].a43_result)

   console.log(calendar);
  } catch (error) {
   console.log(error);
  }
 }
 fetchData();
</script>
@endsection