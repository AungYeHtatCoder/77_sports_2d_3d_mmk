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
            " id="3d_live">
      990
    </button>
  </div>

  <p class="text-center mt-2" style="
            color: var(--Font-Body, #5a5a5a);
            font-family: Poppins;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
          ">
    Updated Date: <span id="updated_date"></span>
  </p>

  <div class="mt-4">
    <ul class="list-group" id="result">


    </ul>
  </div>
</div>
<!-- <div style="font-family: 'Poppins', sans-serif">
    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>

    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>

    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>

    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>

    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>

    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>

    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>

    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>

    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>

    <div class="d-flex justify-content-between align-items-center m-2 px-3 pt-3" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p style="font-size: 14px; color: #abb1cc">2023-11-16</p>
      <p style="font-size: 16px; color: #dde3f0">990</p>
    </div>
  </div> -->
<!-- content section end -->
</div>
@include('user_layout.footer')
@endsection

@section('script')
<script>
  async function fetchData() {
    const url = 'https://shwe-2d-live-api.p.rapidapi.com/3d-live';
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


      $("#3d_live").text(result[0].num)
      $("#updated_date").text(result[0].date)

      let newHTML = '';
      result.forEach(r => {
        newHTML += `
            <li class="rounded-3 list-group-item my-2 threed_list" style="border-radius: 10px; background: var(--Primary, #12486b)">
                <div class="d-flex justify-content-between align-items-center">
                <div>
                <h5 class="text-white">Date</h5>
                <span class="text-info">${r.date}</span>
                </div>
                <div>
                <h5 class="text-white">3D</h5>
                <span class="text-warning">${r.num}</span>
                </div>
                </div>
            </li>
            `;
      });
      $('#result').html(newHTML);

    } catch (error) {
      console.error(error);
    }
  }
  fetchData();
</script>
@endsection