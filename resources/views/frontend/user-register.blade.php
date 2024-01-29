@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row" style="min-height: 100vh;">
    <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8;">
        <img src="{{ asset('user_app/assets/images/login.jpg') }}" class="w-100 my-2" alt="">
        <h5 class="text-center mt-2">အကောင့်ဖွင့်ပါ</h5>
        <div class="px-2">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="w-100 my-3 mx-auto py-2">
                    <input type="text" name="name" class="form-control"  placeholder="အမည်ထည့်ပါ" />
                    @error('name')
                    <span class="text-danger d-block">
                        *{{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="w-100 my-3 mx-auto py-2">
                    <div class="d-flex">
                        <select class="form-control form-select" name="country_code" id="code" style="width: 150px;">
                            @foreach ($countryCodes as $code)
                            <option value="{{ $code->code }}">{{ $code->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="phone" class="form-control" placeholder="ဖုန်းနံပါတ် ဖြည့်ပါ" />
                    </div>
                    @error('phone')
                    <span class="text-danger d-block">
                        *{{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="w-100 my-3 mx-auto py-2">
                    <input type="password" name="password" class="form-control" placeholder="လျှို့ဝှက်နံပါတ်ဖြည့်ပါ" />
                    @error('password')
                    <span class="text-danger d-block">
                        *{{ $message }}
                    </span>
                    @enderror
                </div>
                {{-- <div class="w-75 my-3 mx-auto py-2">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="နောက်တစ်ခါ လျှို့ဝှက်နံပါတ်ဖြည့်ပါ"/>
                    @error('password_confirmation')
                    <span class="text-danger d-block">
                        *{{ $message }}
                    </span>
                    @enderror
                </div> --}}
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" name="signin_btn" class="btn btn-outline-primary w-100 mx-auto py-2">၀င်မည်</button>
                </div>
                <hr/>

                <div class="d-flex justify-content-center align-items-center">
                    <span>အကောင့်ရှိပြီးပါပြီ။ </span>
                    <a href="{{ url('/login') }}" class="ms-1" style="text-decoration: none;">အကောင့်ဝင်မည်။</a>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- @include('user_layout.footer') --}}


@endsection
