@extends('layouts.admin_app')
@section('styles')
    <style>
        .image-container {
            position: absolute;
            top: 0;
            left: 0;
        }

        .image {
            max-width: 20%;
            height: auto;
            opacity: 0.8;
            /* Adjust the opacity as needed */
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-lg-3 position-sticky col-md-6">
                <div class="card mb-3">
                    <div class="card-header mx-4 p-3 text-center">
                        <div class="avatar avatar-xl position-relative">
                            @if(Auth::user()->profile)
                            <img src="{{ Auth::user()->img_url }}" alt="bruce" class="w-100 rounded-circle shadow-sm">
                            @else
                            <i class="fas fa-user-circle fa-3x text-dark"></i>
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('admin.profiles.update', Auth::user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body pt-0 p-3 text-center">
                            <div class="input-group input-group-outline">
                                <input type="file" class="form-control" name="profile">
                            </div>
                            <hr class="horizontal dark mt-2">
                            <div class="mt-4 mx-auto mb-2">
                                <button class="btn bg-gradient-primary btn-sm float-end">Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card top-1">
                    <div class="card-header mx-4 p-3 text-center">
                        <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                            <i class="material-icons opacity-10">account_balance_wallet</i>
                        </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                        <h6 class="text-center mb-0">Total Balance</h6>
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assets/img/mmflag.png') }}" width="40px" alt="" class="d-block m-1 border border-3 border-success" id="mmk" style="cursor: pointer;">
                            <img src="{{ asset('assets/img/thai.webp') }}" width="40px" alt="" class="d-block m-1" id="baht" style="cursor: pointer;">
                        </div>
                        <!-- <span class="text-xs">Freelance Payment</span> -->
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0 mmk"> {{ number_format(Auth::user()->balance) }} MMK</h5>
                        @php
                            $balance = Auth::user()->balance;
                            $balance_baht = $balance / $currency->rate;
                        @endphp
                        <h5 class="mb-0 d-none baht"> {{ number_format($balance_baht) }} BAHT</h5>
                    </div>
                </div>
                {{-- <div class="card-body">
                    <div class="card mt-4" id="basic-info">
                        <div class="card-header">
                            <h5>Add Payment No</h5>
                        </div>
                        <form action="{{ route('admin.changeKpayNo', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="input-group input-group-static">
                                        <label>Kpay No</label>
                                        <input type="text" name="kpay_no" class="form-control"
                                            value="{{ Auth::user()->kpay_no }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>CB Pay No</label>
                                        <input name="cbpay_no" type="text" class="form-control"
                                            value="{{ Auth::user()->cbpay_no }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>Wave Pay No</label>
                                        <input type="text" name="wavepay_no" class="form-control"
                                            value="{{ Auth::user()->wavepay_no }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>AYA Pay No</label>
                                        <input type="number" name="ayapay_no" class="form-control"
                                            value="{{ Auth::user()->ayapay_no }}">
                                    </div>
                                </div>
                                <div class=" mt-3 mb-3 me-4">
                                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end">Add Payment No
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-9 mt-lg-0 mt-4">
                <!-- Card Profile -->
                <div class="card card-body" id="profile">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-sm-auto col-4">
                            <div class="avatar avatar-xl position-relative">
                                @if(Auth::user()->profile)
                                <img src="{{ Auth::user()->img_url }}" alt="bruce" class="w-100 rounded-circle shadow-sm">
                                @else
                                <i class="fas fa-user-circle fa-3x text-dark"></i>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-auto col-8 my-auto">
                            <div class="h-100">
                                <h5 class="mb-1 font-weight-bolder">
                                    {{ Auth::user()->name }}
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    Account ID - 00{{ Auth::user()->id }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Basic Info -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mt-4" id="basic-info">
                            <div class="card-header">
                                <h5>Basic Info</h5>
                            </div>
                            <form action="{{ route('admin.changePhoneAddress', Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="input-group input-group-static">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="input-group input-group-static">
                                            <label>Email</label>
                                            <input type="email" class="form-control" value="{{ Auth::user()->email }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="input-group input-group-static">
                                            <label>Phone Number</label>
                                            <input type="number" name="phone" class="form-control"
                                                value="{{ Auth::user()->phone }}">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="input-group input-group-static">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ Auth::user()->address }}">
                                        </div>
                                    </div>
                                </div>
                                <div class=" mt-1 mb-3 me-4">
                                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end">Update Account
                                        Info
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mt-4 pb-3" id="password">
                            <div class="card-header">
                                <h5>Change Password</h5>
                            </div>
                            <form action="{{ route('admin.changePassword', Auth::user()->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                            <div class="card-body pt-0">
                                <div class="input-group input-group-outline my-4">
                                    <label class="form-label">New password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <h5 class="mt-3">Password requirements</h5>
                                <p class="text-muted mb-2">
                                    Please follow this guide for a strong password:
                                </p>
                                <ul class="text-muted ps-4 mb-0 float-start">
                                    <li>
                                        <span class="text-sm">One special characters</span>
                                    </li>
                                    <li>
                                        <span class="text-sm">Min 6 characters</span>
                                    </li>
                                    <li>
                                        <span class="text-sm">One number (2 are recommended)</span>
                                    </li>
                                    <li>
                                        <span class="text-sm">Change it often</span>
                                    </li>
                                </ul>
                                <button type="submit" class="btn bg-gradient-dark btn-sm float-end mb-0">Update password</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card Change Password -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#mmk').click(function(){
            $('#mmk').addClass(['border', 'border-3', 'border-success'])
            $('#baht').removeClass(['border', 'border-3', 'border-success'])

            $('.mmk').removeClass('d-none')
            $('.baht').addClass('d-none')
        })
        $('#baht').click(function(){
            $('#mmk').removeClass(['border', 'border-3', 'border-success'])
            $('#baht').addClass(['border', 'border-3', 'border-success'])

            $('.mmk').addClass('d-none')
            $('.baht').removeClass('d-none')
        })
    })
</script>
@endsection