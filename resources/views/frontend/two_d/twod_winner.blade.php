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
                2D ကံထူးရှင်စာရင်းများ
        </p>
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


        <div>

                <span class="font-weight-bold" style="font-size: 30px;color: #fff">{{ $winners->count() }}
                        @if($winners->count() > 1)
                        ကံထူးရှင်များ
                        @else
                        ကံထူးရှင်များ
                        @endif
                </span>
        </div>

        <div class="p-1" style="border-bottom: 200px;">
                @if($winners->isEmpty())
                <p class="text-danger text-center fs-5">No winners found for the past month.</p>
                @else
                <table class="winner-table table table-striped">
                        @foreach($winners as $index => $winner)
                        <tr>
                                {{-- <td class="mt-2">1.</td> --}}
                                <td>
                                        {{ $index + 1 }}
                                </td>
                                <td>
                                        @if($winner->profile)
                                        <img src="{{ $winner->profile }}" width="50px" height="50px" style="border-radius: 50%" alt="" />
                                        @else
                                        <i class="fa-regular fa-circle-user" style="font-size: 50px;"></i>
                                        @endif
                                </td>
                                <td><span style="font-size: 10px">{{ $winner->name }}</span>
                                        <p style="font-size: 10px">{{ $winner->phone }}</p>
                                </td>
                                {{-- <td><span>Session</span>
            <p>{{ ucfirst($winner->session) }}</p>
                                </td> --}}
                                <td><span>ပေါက်ဂဏန်း</span>
                                        <p>{{ $winner->prize_no }}</p>
                                </td>
                                <td><span>ထိုးငွေ</span>
                                        <p>{{ $winner->sub_amount }}</p>
                                </td>
                                <td><span>ထီပေါက်ငွေ</span>
                                        <p>{{ $winner->prize_amount }}</p>
                                </td>
                        </tr>
                        @endforeach

                </table>
                @endif

        </div>

        <!-- <div class="d-flex justify-content-between align-items-center p-2 mx-3 my-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
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
 </div> -->


</div>
<!-- content section end -->

@include('user_layout.footer')
@endsection