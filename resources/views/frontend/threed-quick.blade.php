@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<!-- quick play start -->
<div class="mt-5 pt-5 mx-3">
 <p class="quick-text text-center">(3)လုံးပူး ဂဏန်းများ</p>
 <div class="quick-box">
  <div class="quick-digit">
   <span>111</span>
  </div>
  <div class="quick-digit">
   <span>222</span>
  </div>
  <div class="quick-digit">
   <span>333</span>
  </div>
  <div class="quick-digit">
   <span>444</span>
  </div>
  <div class="quick-digit">
   <span>555</span>
  </div>
  <div class="quick-digit">
   <span>666</span>
  </div>
  <div class="quick-digit">
   <span>777</span>
  </div>
  <div class="quick-digit">
   <span>888</span>
  </div>
  <div class="quick-digit">
   <span>999</span>
  </div>
 </div>

 <p class="quick-text py-4 text-center">အကွက် ၁၀၀</p>
 <div class="quick-box">
  <div class="quick-digit">000-999</div>
  <div class="quick-digit">100-199</div>
  <div class="quick-digit">200-299</div>
  <div class="quick-digit">300-399</div>
  <div class="quick-digit">400-499</div>
  <div class="quick-digit">500-599</div>
  <div class="quick-digit">600-699</div>
  <div class="quick-digit">700-799</div>
  <div class="quick-digit">800-899</div>
 </div>

 <div class="py-3">
  <p class="quick-text" style="font-size: 14px; font-style: normal; font-weight: 400">
   ဂဏန်းအရေအတွက်:
   <span class="quick-text" style="font-size: 20px; line-height: 24px">303</span>
  </p>

  <label for="number" class="my-2" style="color: var(--Font-Heading, #232323)">
   ထိုးကြေး
  </label>
  <input type="text" class="form-control" placeholder="ငွေပမာဏ  အနည်းဆုံး (၁၀၀ ကျပ်)" style="
              border: 1px solid var(--System-Gray-500, #9e9e9e);
              background: var(--System-White, #fff);
            " />
 </div>
</div>
<!-- quick play end -->

<!-- footer section start  -->
<footer class="fixed-bottom bg-white py-3 mx-auto">
 <div class="row">
  <div class="col">
   <a href="" style="
                display: flex;
                padding: 10px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 10px;
                border: 1px solid #fe0000;
                color: #fe0000;
              ">ဖျက်မည်</a>
  </div>
  <div class="col">
   <a href="" style="
                display: flex;
                padding: 10px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 10px;
                background: var(--Primary, #12486b);
              ">ထိုးမည်</a>
  </div>
 </div>
</footer>
<!-- footer section end -->

@endsection

@section('script')

@endsection