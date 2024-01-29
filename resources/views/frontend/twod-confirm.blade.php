@extends('user_layout.app')

@section('content')
@include('user_layout.nav')

<div class="profiles mx-3" style="
          border-radius: 20px;
          background: var(--Scondary, #419197);
          height: 60vh;
        ">
 <p style="
            color: #fff;

            text-align: center;
            font-family: Noto Sans Myanmar;
            font-size: 20px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
            letter-spacing: -0.318px;
          ">
  ထိုးမည့် ဂဏန်းများ
 </p>
 <table class="text-center" style="background: var(--Scondary, #419197)">
  <tr>
   <th class="px-3">စဉ်</th>
   <th class="px-3">ဂဏန်း</th>
   <th class="px-3">ငွေပမာဏ</th>
   <th class="px-3">ပြင် / ဖျက်</th>
  </tr>
  <tr>
   <td>1</td>
   <td>123</td>
   <td>100</td>
   <td>
    <div class="d-flex justify-content-center">
     <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
     <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
    </div>
   </td>
  </tr>
  <tr>
   <td>2</td>
   <td>223</td>
   <td>100</td>
   <td>
    <div class="d-flex justify-content-center">
     <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
     <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
    </div>
   </td>
  </tr>
  <tr>
   <td>3</td>
   <td>223</td>
   <td>100</td>
   <td>
    <div class="d-flex justify-content-center">
     <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
     <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
    </div>
   </td>
  </tr>
  <tr>
   <td>4</td>
   <td>123</td>
   <td>100</td>
   <td>
    <div class="d-flex justify-content-center">
     <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
     <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
    </div>
   </td>
  </tr>
  <tr>
   <td>5</td>
   <td>223</td>
   <td>100</td>
   <td>
    <div class="d-flex justify-content-center">
     <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
     <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
    </div>
   </td>
  </tr>
  <tr>
   <td>6</td>
   <td>223</td>
   <td>100</td>
   <td>
    <div class="d-flex justify-content-center">
     <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
     <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
    </div>
   </td>
  </tr>
 </table>
</div>
<div class="mx-3 py-2" style="border-radius: 20px; background: var(--Scondary, #419197)">
 <div class="mx-5" style="border-radius: 10px; opacity: 0.3; background: #fff">
  <p class="text-dark" style="
              text-align: center;
              font-size: 24px;
              font-weight: 500;
              line-height: 57.946px;
            ">
   32,400 <small>MMK</small>
  </p>
 </div>
</div>

@include('user_layout.footer')
@endsection