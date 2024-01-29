@extends('user_layout.app')

@section('style')
<style>
  .main-container{
    margin-top: 70px;
    margin-bottom: 83px;
    padding-bottom: 10px;
    color: #232323;
  }
  .sub-container{
    color: var(--Font-Heading, #232323);
    text-align: center;
    font-family: Noto Sans Myanmar;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    text-transform: capitalize;
  }
  .form{
    font-size: 14px;
    position: relative;
    color: var(--Text-Body, #abb1cc);
  }
  .input{
    border: 1px solid var(--System-Gray-500, #9e9e9e);
    background: var(--System-White, #fff);
  }
</style>
@endsection

@section('content')
@include('user_layout.nav')
<!-- content section start -->
<div class="main-container">
 <div class="text-center p-2 sub-container">
  <p style="font-size: 16px">ငွေဖြည့်မည်</p>
  <p style="font-size: 14px" class="pb-0 mb-0">
   ကျေးဇူးပြု၍ အောက်ပါ {{ $bank->bank }} အကောင့်သို့ ငွေဖြည့်သွင်းပါ။
  </p>
 </div>

 <form id="cashIn" method="POST" action="{{ route('cashInRequest') }}" class="mx-2 form">
  @csrf
  <label for="ph-number" class="my-2">ငွေလက်ခံမည့်ဖုန်းနံပါတ်</label>
  <input type="text" class="form-control input" id="receiver" placeholder="" value="{{ $bank->phone }}" disabled />
  <img onclick="copyText()" src="{{ asset('user_app/assets/img/content_copy.png') }}" style="position: absolute; top: 45px; right: 10px; cursor: pointer;" alt="" />
  <input type="hidden" name="payment_method" value="{{ $bank->bank }}">


  <label for="number" class="my-2"> သင်၏ {{ $bank->bank }} ဖုန်းနံပါတ်ထည့်ပါ </label>
  <input type="number" name="phone" class="form-control input" placeholder="" />
  @error('phone')
    <span class="text-danger d-block">*{{ $message }}</span>
  @enderror

  {{-- <label for="name" class="my-2"> သင်၏ {{ $bank->bank }} ငွေလွှဲသူအမည် </label>
  <input type="text" name="name" class="form-control input" placeholder="" />
  @error('name')
    <span class="text-danger d-block">*{{ $message }}</span>
  @enderror --}}

  <label for="ph-digit" class="my-2">လုပ်ဆောင်မှုအမှတ်စဥ် (နောက်ဆုံးဂဏန်း ၆ လုံး)</label>
  <input name="last_6_num" type="number" class="form-control input" placeholder="" />
  @error('last_6_num')
    <span class="text-danger d-block">*{{ $message }}</span>
  @enderror

  <input type="hidden" name="currency" value="{{ $bank->currency }}">
  {{-- <div class="mt-3 d-flex">
    <div>
      <input type="radio" name="currency" id="kyat" value="ကျပ်">
      <label for="kyat" class="form-label">ကျပ်</label>
    </div>
    <div class="ms-3">
      <input type="radio" name="currency" id="baht" value="ဘတ်">
      <label for="baht" class="form-label">ဘတ်</label>
    </div>
  </div>
  @error('currency')
    <span class="text-danger d-block">*{{ $message }}</span>
  @enderror --}}

  <label for="amount" class="my-2"> ငွေဖြည့်မည့် ပမာဏ</label>
  <input name="amount" id="inputField" type="number" class="form-control input" placeholder="" />
  @error('amount')
    <span class="text-danger d-block">*{{ $message }}</span>
  @enderror
 </form>

 <div class="d-flex justify-content-center align-items-center my-3">
  <button class="topup-btns" data-value="1000" onclick="fillInputBox(this)">1000</button>
  <button class="topup-btns" data-value="2000" onclick="fillInputBox(this)">2000</button>
  <button class="topup-btns" data-value="3000" onclick="fillInputBox(this)">3000</button>
 </div>
 <div class="d-flex justify-content-center align-items-center my-3">
  <button class="topup-btns" data-value="10000" onclick="fillInputBox(this)">10000</button>
  <button class="topup-btns" data-value="20000" onclick="fillInputBox(this)">20000</button>
  <button class="topup-btns" data-value="50000" onclick="fillInputBox(this)">50000</button>
 </div>

 <div style="margin: 0 10px">
  <button onclick="document.getElementById('cashIn').submit()" class="w-100 p-3 my-2 rounded border border-none" style="background: var(--Primary, #12486b); color: #ffe9f8">
   ငွေဖြည့်မည်
  </button>
 </div>

 <div class="m-2 p-2" style="
            background: var(
              --Primary-Linear-01,
              linear-gradient(93deg, #55aab0 -9.97%, #12486b 110.58%)
            );
            border-radius: 24px;
            border: 1px solid #bec6f6;
          ">
  <p class="text-center" style="
              color: #fff;
              text-align: center;
              font-family: Noto Sans Myanmar;
              font-size: 12px;
              font-style: normal;
              font-weight: 500;
              line-height: 16px; /* 133.333% */
              text-transform: capitalize;
            ">
   ငွေဖြည့်ရန်အဆင်မပြေမှုတစ်စုံတစ်ရာရှိပါက ဆက်သွယ်ရန်
  </p>
  <div class="d-flex justify-content-center align-items-center" style="gap: 16px">
   <img src="{{ asset('user_app/assets/img//telegram.png') }}" alt="" />
   <img src="{{ asset('user_app/assets/img//viber.png') }}" alt="" />
   <img src="{{ asset('user_app/assets/img//line.png') }}" alt="" />
   <img src="{{ asset('user_app/assets/img//Facebook.png') }}" alt="" />
  </div>
 </div>
</div>
<!-- content section end -->
@include('user_layout.footer')
@endsection

@section('script')
<script>
  function copyText() {
    var inputElement = document.getElementById("receiver");
  
    // Select the text in the input field
    inputElement.select();
  
    // Copy the selected text
    document.execCommand("copy");
    // alert('copied text!');
  
    // Deselect the input field
    inputElement.setSelectionRange(0, 0);
  
    alert("Text copied: " + inputElement.value);
  }
</script>
<script>
  function fillInputBox(element) {
    let value = element.getAttribute('data-value');
    console.log(value);
    let inputField = document.getElementById('inputField');
    inputField.value = value;
  }
</script>
@endsection