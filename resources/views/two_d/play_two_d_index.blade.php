@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8; ">
  <div class="flesh-card">
   <div class="d-flex">
    <span class="material-icons">account_balance_wallet</span>
    <p class="px-2 mt-1">လက်ကျန်ငွေ</p>
   </div>
   <p>{{ Auth::user()->balance }} Kyat</p>
  </div>
  <div class="card text-center">
   <div class="card-body">
    <div class="d-flex p-1 justify-content-around">
     <div>
      <a href="#" class="text-decoration-none">
       <span class="material-icons">manage_search</span>
       <p>မှတ်တမ်း</p>
      </a>
     </div>
     <div>
      <a href="#" class="text-decoration-none">
       <span class="material-icons">stars</span>
       <p>ကံထူးရှင်များ</p>
      </a>
     </div>
     <div>
      <a href="#" class="text-decoration-none">
       <span class="material-icons">event_note</span>
       <p>ပိတ်ရက်</p>
      </a>
     </div>
    </div>
   </div>
  </div>

  <div class="results">
   <h1 id="live_2d">71</h1>
   <p class="text-center">
    Updated:
    <span id="live_updated_time">11-11-2023 4:31:59PM</span>
   </p>

   <button type="button" class="btns" data-bs-toggle="modal" data-bs-target="#exampleModal">ထိုးမည်</button>

  </div>
  <div class="container-fluid" style="margin-bottom:80px;" id="result"></div>
  {{-- <div class="container mb-4" style="padding-bottom: 200px">
   <div class="card text-center p-0 cards" style="background-color: #2a576c">
    <div class="card-body">
     <p class="text-center text-white">11:00:00</p>
     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>Set</p>
       <p>Value</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>

   <div class="card text-center p-0 cards mt-3" style="background-color: #2a576c">
    <div class="card-body">
     <p class="text-center text-white">11:00:00</p>
     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>Set</p>
       <p>Value</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>

   <div class="card text-center p-0 cards mt-3" style="background-color: #2a576c">
    <div class="card-body">
     <p class="text-center text-white">11:00:00</p>
     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>Set</p>
       <p>Value</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>
  </div> --}}
 </div>
</div>

<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">ထိုးမည့်အချိန် (section) ကိုရွေးပါ</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body">
    <div class="modal-btn mt-2">
      @if ($lottery_matches->is_active == 1)
     <a href="{{ url('/user/two-d-play-index-simple') }}" class="text-decoration-none btn">9:30 AM</a>
    </div>
    <div class="modal-btn mt-2">
     <a href="{{ url('/user/two-d-play-index-12pm') }}" class="text-decoration-none btn">12:00 AM</a>
    </div>
    <div class="modal-btn mt-2">
     <a href="{{ url('/user/two-d-play-index-2pm') }}" class="text-decoration-none btn">2:00 AM</a>
    </div>
    <div class="modal-btn mt-2">
     <a href="{{ url('/user/two-d-play-index-4pm') }}" class="text-decoration-none btn">4:30 PM</a>
     @else
          <div class="text-center p-4">
            <h4>ပွဲချိန်ခေတ္တ ပိတ်ထားပါသည် </h4>
            <h3>Sorry, you can't play now. Please wait for the next round.</h3>
          </div>
          @endif
    </div>
   </div>
   <div class="modal-footer">
    {{-- <button type="button" class="btn modal-button">ထိုးမည်</button> --}}
   </div>
  </div>
 </div>
</div>
@include('user_layout.footer')
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
                            <div class="card digit-card mb-1 pt-3">
                              <p class="text-center">${r.open_time}</p>
                              <div class="d-flex justify-content-around">
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
