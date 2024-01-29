@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div style="padding: 80px 0; font-family: 'Noto Sans Myanmar', sans-serif">
  <!-- content section start -->
  <div class="d-flex justify-content-center align-items-center" style="font-weight: 600">
    <button type="button" class="text-white" style="
              width: 100px;
              height: 100px;
              border: none;
              outline: none;
              border-radius: 50%;
              padding: 10px;
              background: var(
                --Primary-Linear-01,
                linear-gradient(93deg, #55aab0 -9.97%, #12486b 110.58%)
              );
              font-size: 36px;
            " id="two_d_live">
      83
    </button>
  </div>
  <p class="text-center mt-2" style="
            color: var(--Font-Body, #5a5a5a);
            font-family: Poppins;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
          " id="updated_time">
    Last Update: 30 Nov 2023 04:29:44 PM
  </p>

  <div style="font-family: 'Poppins', sans-serif">
    <div class="d-flex justify-content-around align-items-center m-2 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div>
        <p style="font-size: 16px; color: #dde3f0">AM</p>
        <p style="font-size: 14px; color: #abb1cc">Live</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">BTC</p>
        <p style="font-size: 14px; color: #abb1cc" id="live_set">1,380.81</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">ETH</p>
        <p style="font-size: 14px; color: #abb1cc" id="live_value">76,183.57</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">2D</p>
        <p style="font-size: 14px; color: #abb1cc" id="live_result">83</p>
      </div>
    </div>

    <div class="d-flex justify-content-around text-center align-items-center m-2 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div>
        <p style="font-size: 16px; color: #dde3f0" id="">AM</p>
        <p style="font-size: 14px; color: #abb1cc">9:30</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">Internet</p>
        <p style="font-size: 14px; color: #abb1cc" id="a9_internet">1,380.81</p>
      </div>
      <div>
        <p style=" font-size: 16px; color: #dde3f0">Modern</p>
        <p style="font-size: 14px; color: #abb1cc" id="a9_modern">76,183.57</p>
      </div>
      <!-- <div>
        <p style="font-size: 16px; color: #dde3f0">2D</p>
        <p style="font-size: 14px; color: #abb1cc">83</p>
      </div> -->
    </div>

    <div class="d-flex justify-content-around text-center align-items-center m-2 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div>
        <p style="font-size: 16px; color: #dde3f0">AM</p>
        <p style="font-size: 14px; color: #abb1cc">12:00</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">BTC</p>
        <p style="font-size: 14px; color: #abb1cc" id="a12_set">1,380.81</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">ETH</p>
        <p style="font-size: 14px; color: #abb1cc" id="a12_value">76,183.57</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">2D</p>
        <p style="font-size: 14px; color: #abb1cc" id="a12_result">83</p>
      </div>
    </div>

    <div class="d-flex justify-content-around text-center align-items-center m-2 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div>
        <p style="font-size: 16px; color: #dde3f0">PM</p>
        <p style="font-size: 14px; color: #abb1cc">02:00</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">Internet</p>
        <p style="font-size: 14px; color: #abb1cc" id="a2_internet">1,380.81</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">Modern</p>
        <p style="font-size: 14px; color: #abb1cc" id="a2_modern">76,183.57</p>
      </div>
      <!-- <div>
        <p style="font-size: 16px; color: #dde3f0">2D</p>
        <p style="font-size: 14px; color: #abb1cc">83</p>
      </div> -->
    </div>

    <div class="d-flex justify-content-around text-center align-items-center m-2 pt-2" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <div>
        <p style="font-size: 16px; color: #dde3f0">PM</p>
        <p style="font-size: 14px; color: #abb1cc">04:30</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">BTC</p>
        <p style="font-size: 14px; color: #abb1cc" id="a43_set">1,380.81</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">ETH</p>
        <p style="font-size: 14px; color: #abb1cc" id="a43_value">76,183.57</p>
      </div>
      <div>
        <p style="font-size: 16px; color: #dde3f0">2D</p>
        <p style="font-size: 14px; color: #abb1cc" id="a43_result">83</p>
      </div>
    </div>
  </div>
  <!-- content section end -->
</div>
@include('user_layout.footer')
@endsection

@section('script')
<script>
  async function fetchData() {
    const url = 'https://shwe-2d-live-api.p.rapidapi.com/live';
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


      // document.getElementById("two_d_live").innerText = result.live_result
      $("#updated_time").text(result.update);

      $("#two_d_live").text(result.live_result);
      $("#live_result").text(result.live_result);
      $("#live_set").text(result.live_set);
      $("#live_value").text(result.live_value);

      // $("#a9_result").text(result.a9_internet);
      $("#a9_internet").text(result.a9_internet);
      $("#a9_modern").text(result.a9_modern);

      $("#a12_result").text(result.a12_result);
      $("#a12_set").text(result.a12_set);
      $("#a12_value").text(result.a12_value);

      // $("#a2_result").text(result.a2_internet);
      $("#a2_internet").text(result.a2_internet);
      $("#a2_modern").text(result.a2_modern);

      $("#a43_result").text(result.a43_result);
      $("#a43_set").text(result.a43_set);
      $("#a43_value").text(result.a43_value);
      // console.log(result);
    } catch (error) {
      console.error(error);
    }
  }
  fetchData();
</script>
@endsection