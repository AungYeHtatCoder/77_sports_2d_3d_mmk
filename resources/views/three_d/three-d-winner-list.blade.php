@extends('user_layout.app')

@section('content')
@include('user_layout.nav')

<!-- content section start -->
<div style="padding: 80px 0 40px 0" style="
          font-size: 16px;
          font-family: 'Poppins', sans-serif;
          color: #abb1cc;
          gap: 8px;
        ">
  <p class="text-center my-2" style="
            color: var(--Font-Body, #5a5a5a);
            text-align: center;
            font-family: Noto Sans Myanmar;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
          ">
    3D ကံထူးရှင်စာရင်းများ
  </p>
  {{-- three-d-winner-list.blade.php --}}
  <div class="">
    <table class="table" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <thead>
        <tr>
          <th class="py-2" style="font-size: 16px; color: #172543">Name</th>
          <th class="text-end py-2" style="font-size: 16px; color: #172e60">3D</th>
          <th>Amount</th>
          <th>Prize</th>
          <th>Rank</th>
        </tr>
      </thead>
      <tbody>
        @foreach($winners as $winner)
        @foreach($winner->threedDigits as $threedDigit)
        <tr class="align-middle">
          <td class="py-2">
            <div class="d-flex align-items-center">
              <img src="{{ asset('user_app/assets/img/Ellipse 644.png') }}" class="me-3" alt="" />
              <div>
                <p class="mb-0" style="font-size: 16px; color: #2867ee">{{ $winner->user->name }}</p>
                <!-- <span style="font-size: 14px; color: #1586a9">{{ $winner->user->id }}</span> -->
              </div>
            </div>
          </td>
          <td class="text-end py-2">{{ $threedDigit->pivot->three_digit }}</td>
          <td class="text-end py-2">{{ $threedDigit->pivot->sub_amount }}</td>
          <td class="text-end py-2">{{ $threedDigit->pivot->prize_sent ? 'Yes' : 'No' }}</td>

          {{-- Assuming 'Rank' is a field or property you can access --}}
          <td class="text-end py-2">
            <div class="position-relative" style="width: 18px; height: 20px;">
              {{-- You can dynamically show the ribbon based on the rank or any other condition --}}
              @if($threedDigit->prize_sent == 1)
              <img src="{{ asset('user_app/assets/img/icons/ribbon.png') }}" class="position-absolute" style="left: -1px; top: -5px" alt="" />
              @endif
              <img src="{{ asset('user_app/assets/img/icons/gold.png') }}" alt="" />
            </div>
          </td>
        </tr>
        @endforeach
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- <div class="table-responsive">
  <table class="table mx-3 my-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
    <thead>
      <tr>
        <th class="py-2" style="font-size: 16px; color: #172543">Name</th>
        <th class="text-end py-2" style="font-size: 16px; color: #172e60">3D</th>
        <th>Amount</th>
        <th>Prize</th>
        <th>Rank</th>
      </tr>
    </thead>
    <tbody>
      <tr class="align-middle">
        <td class="py-2">
          <div class="d-flex align-items-center">
            <img src="{{ asset('user_app/assets/img/Ellipse 644.png') }}" class="me-3" alt="" />
  <div>
    <p class="mb-0" style="font-size: 16px; color: #2867ee">Thiha Aung</p>
    <span style="font-size: 14px; color: #1586a9">ID1028403820481</span>
  </div>
</div>
</td>
<td class="text-end py-2">123</td>
<td class="text-end py-2">1000</td>
<td class="text-end py-2">100000</td>


<td class="text-end py-2">
  <div class="position-relative" style="width: 18px; height: 20px;">
    <img src="{{ asset('user_app/assets/img/icons/ribbon.png') }}" class="position-absolute" style="left: -1px; top: -5px" alt="" />
    <img src="{{ asset('user_app/assets/img/icons/gold.png') }}" alt="" />
  </div>
</td>
</tr>
</tbody>
</table>
</div> --}}

{{-- <div class="d-flex justify-content-between align-items-center p-2 mx-3 my-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
  <div class="d-flex justify-content-start align-items-start">
   <img src="{{ asset('user_app/assets/img/Ellipse 644.png') }}" class="d-flex me-3" alt="" />
<div class="mt-1" style="line-height: 8px">
  <p class="d-block" style="font-size: 16px; color: #dde3f0">
    Thiha Aung
  </p>
  <span class="d-block" style="font-size: 14px; color: #abb1cc">ID1028403820481</span>
</div>
</div>


<div style="position: relative" width="18px" height="20px" class="me-3">
  <img src="{{ asset('user_app/assets/img/icons/ribbon.png') }}" style="position: absolute; left: -1px; top: -5px" alt="" />
  <img src="{{ asset('user_app/assets/img/icons/gold.png') }}" alt="" />
</div>
</div> --}}


</div>
<!-- content section end -->

@include('user_layout.footer')
@endsection