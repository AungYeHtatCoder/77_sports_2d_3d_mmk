@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<!-- content section start -->
<div style="padding-top: 30px;">
  <div class="row" style="padding-top: 30px;">
    <div class="col-6">
      <div class="card">
      <div class="row">
        <div class="col-12">
          <div class="card-header">
        <h6 class="text-center text-dark">
          Balance -
          {{ Auth::user()->balance }} 
        </h6>
      </div>
        </div>
      </div>
    </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-header">
      <h6>
            @if(Auth::user()->commission_balance > 0)
            Com - Balance
            {{ Auth::user()->commission_balance }}
            @else
            00
            @endif
          </h6>
    </div>
      </div>
      <div class="card">
{{-- update balance form --}}
        <div class="card-header">
          <form action="{{ route('balanceUpdate') }}" method="post">
            @csrf
            @method('PUT')
            <div class="d-flex justify-content-center align-items-center my-2">
              <input type="hidden" name="balance" value="{{ Auth::user()->commission_balance }}" class="w-75 rounded border border-none p-2" style="font-size: 14px;line-height: 20px;outline: none;color: #757575;" />
            </div>
            <div class="d-flex justify-content-center align-items-center">
              <button type="submit" class="w-75 mx-2 py-2 rounded text-white border border-none" style="background: var(--linear);font-size: 18px;">ပိုက်ဆံအိပ်ထဲသို့ပြောင်းပါ</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <div class="d-flex justify-content-around align-items-center">
    
    
    <div class="mt-5 me-0">
      @if(Auth::user()->profile)
      <div class="d-flex justify-content-center pt-2 mb-3">
        <label for="photoInput" style="cursor: pointer;">
          <img src="{{ Auth::user()->img_url }}" width="150px" height="150px" class="rounded-circle border border-2 border-success" alt="">
        </label>
      </div>
      @else
      <div class="d-flex justify-content-center pt-2">
        <label for="photoInput" style="cursor: pointer;">
          <img src="{{ asset('user_app/assets/img/profile-img.png') }}" class="rounded-circle border border-2 border-success" width="100%" alt="">
        </label>
      </div>
      @endif
      <form id="profileUpdate" action="{{ route('editProfile') }}" class="d-none" enctype="multipart/form-data" method="POST">
        @csrf
        <input class="d-none" type="file" id="photoInput" name="profile">
      </form>
      <script>
        const photoInput = document.getElementById('photoInput');
        const myForm = document.getElementById('profileUpdate');
        photoInput.addEventListener('change', () => {
          if (photoInput.files.length > 0) {
            myForm.submit();
          }
        });
      </script>
    </div>
  </div>
  <h6 class="text-center text-dark">Edit Photo</h6>
  <form form action="{{ route('editInfo') }}" method="post">
    @csrf
    <div class="d-flex justify-content-center align-items-center my-2">
      <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-75 rounded border border-none p-2" style="font-size: 14px;line-height: 20px;outline: none;color: #757575;" />
    </div>

    <div class="d-flex justify-content-center align-items-center my-2">
      <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="w-75 rounded border border-none p-2" style="font-size: 14px;line-height: 20px;outline: none;color: #C0C0C0;" />
    </div>

    <div class="d-flex justify-content-center align-items-center">
      <button type="submit" class="w-75 mx-2 py-2 rounded text-white border border-none" style="background: var(--linear);font-size: 18px;">အတည်ပြုပါ</button>
    </div>
  </form>
</div>

<h6 class="text-center text-dark mt-4">Change Password</h6>
<form form action="{{ route('changePassword') }}" method="post">
  @csrf
  <div class="d-flex justify-content-center align-items-center my-2">
    <input placeholder="Old Password" type="password" name="old_password" value="" class="w-75 rounded border border-none p-2" style="font-size: 14px;line-height: 20px;outline: none;color: #757575;" />

  </div>
  @error('old_password')
  <span class="text-danger text-center ms-5">*{{ $message }}</span>
  @enderror


  <div class="d-flex justify-content-center align-items-center my-2">
    <input placeholder="New Password" type="password" name="password" value="" class="w-75 rounded border border-none p-2" style="font-size: 14px;line-height: 20px;outline: none;color: #C0C0C0;" />
  </div>
  @error('password')
  <span class="text-danger text-center ms-5">*{{ $message }}</span>
  @enderror

  <div class="d-flex justify-content-center align-items-center mt-2">
    <button type="submit" class="w-75 mx-2 py-2 rounded text-white border border-none" style="background: var(--linear);font-size: 18px;">အတည်ပြုပါ</button>
  </div>
</form>
<!-- content section end -->

@include('user_layout.footer')
@endsection

@section('script')

@endsection