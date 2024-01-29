@extends('layouts.admin_app')
@section('styles')

@endsection
@section('content')
<div class="row align-items-center">
        <div class="col-lg-4 col-sm-8">
          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active btn btn-primary text-white"  href="{{ route('admin.fill-balance-replies.index') }}">
                  Back To Balance Access Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1  active " data-bs-toggle="tab" href="#" role="tab" aria-selected="false">
                 {{ $balance->user->name }} 's Balance Send Dashboard
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </div>

      <div class="container-fluid my-3 py-3">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <div class="col-xl-6 col-md-6 mb-xl-0 mb-4">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl">
                  <img src="{{ $balance->user->profile }}" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                  <span class="mask bg-gradient-dark opacity-10"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="material-icons text-white p-2">wifi</i>
                    <h5 class="text-white mt-4 mb-5 pb-2">Client Phone : {{ $balance->user->phone }}</h5>
                    <div class="d-flex">
                      <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Client Name</p>
                          <h6 class="text-white mb-0">{{ $balance->user->name }}</h6>
                        </div>
                        <div>
                          <p class="text-white text-sm opacity-8 mb-0">Join Date</p>
                          <h6 class="text-white mb-0">{{ $balance->user->created_at->format('j M, H:i A') }}</h6>
                        </div>
                      </div>
                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                        <img class="w-60 mt-2" src="{{ asset('admin_app/assets/img/logos/mastercard.png')}}" alt="logo">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-md-6">
              <div class="row">
                <div class="col-md-6 col-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                        <i class="material-icons opacity-10">account_balance</i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Account Balance</h6>
                      <span class="text-xs">Belong Interactive</span>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0">{{ $balance->user->balance }} MMK</h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                        <i class="material-icons opacity-10">account_balance_wallet</i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Bill Request Status</h6>
                      <div class="d-flex align-items-center">
        @if($balance->status == 'accept')
            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center">
                <i class="material-icons text-sm" aria-hidden="true">done</i>
            </button>
            <span>Paid</span>
        @else
            <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center">
                <i class="material-icons text-sm" aria-hidden="true">close</i>
            </button>
            <span>Not Yet Pay</span>
        @endif
    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-lg-0 mb-4">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Payment Method</h6>
                    </div>
                    <div class="col-6 text-end">
                      {{-- <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Card</a> --}}
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <img class="w-10 me-3 mb-0" src="{{ asset('admin_app/assets/img/logos/mastercard.png')}}" alt="logo">
                        <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****</h6>
                        <i class="material-icons ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card">edit</i>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <img class="w-10 me-3 mb-0" src="{{ asset('admin_app/assets/img/logos/visa.png')}}" alt="logo">
                        <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****</h6>
                        <i class="material-icons ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card">edit</i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Bill Information</h6>
                </div>
                <div class="col-6 text-end">
                  <button class="btn btn-outline-primary btn-sm mb-0">View All</button>
                </div>
              </div>
            </div>
            <div class="card-body p-3 pb-0">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark font-weight-bold text-sm">Bill Request Date : {{ $balance->created_at->format('j M, H:i A') }}</h6>
                    <span class="text-xs">Account ID #{{$balance->user->id }}</span>
                  </div>
                  {{-- <div class="d-flex align-items-center text-sm">
                    $180
                    <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="material-icons text-lg position-relative me-1">picture_as_pdf</i> PDF</button>
                  </div> --}}
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 font-weight-bold text-sm">{{ $balance->user->name }}</h6>
                    {{-- <span class="text-xs">#RV-126749</span> --}}
                  </div>
                  
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 font-weight-bold text-sm"> Email : {{ $balance->user->email }}</h6>
                    {{-- <span class="text-xs">#FB-212562</span> --}}
                  </div>
                  
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 font-weight-bold text-sm"> Client Phone : {{ $balance->user->phone }}</h6>
                    
                  </div>
                  
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 font-weight-bold text-sm">Address : {{ $balance->user->address }}</h6>
                    
                  </div>
                  
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 font-weight-bold text-sm">လုပ်ငန်းစဉ်အမှတ် : {{ $balance->last_six_digit }}</h6>
                    
                  </div>
                  
                </li>

                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="text-dark mb-1 font-weight-bold text-sm">
                     @php
                     $paymentMethods = [
                         'kpay_no' => 'KPay',
                         'cbpay_no' => 'CBPay',
                         'wavepay_no' => 'WavePay',
                         'ayapay_no' => 'AyaPay'
                     ];
                 @endphp

                 @foreach ($paymentMethods as $method => $name)
                     @if($balance->{$method})
                         <span class="my-2 text-xs">{{ $name }}: {{ $balance->{$method} }}</span>
                         @break
                     @endif
                 @endforeach

                    </h6>
                    
                  </div>
                  
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
     
     
    </div>

          <div class="row mt-4">
        <div class="col-lg-7 col-12">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Billing Information</h6>
            </div>
            <div class="card-body pt-4 p-3">
               <form action="{{ route('admin.fill-balance-replies.update', $balance->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="input-group input-group-static">
                                            <label>Name</label>
                                            <input type="text" readonly class="form-control"
                                                value="{{ $balance->user->name }}">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="input-group input-group-static">
                                            <label>Email</label>
                                            <input type="email" class="form-control" value="{{ $balance->user->email }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="input-group input-group-static">
                                            <label>Phone Number</label>
                                            <input type="number" readonly class="form-control"
                                                value="{{ $balance->user->phone }}">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="input-group input-group-static">
                                            <label>Address</label>
                                            <input type="text" readonly class="form-control"
                                                value="{{ $balance->user->address }}">
                                        </div>
                                    </div>
                                     <div class="row mt-3">
                                        <div class="input-group input-group-static">
                                            <label>လုပ်ငန်းစဉ်အမှတ်</label>
                                            <input type="text" readonly class="form-control"
                                                value="{{ $balance->last_six_digit }}">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="input-group input-group-static">
                                            <label>Client Account Balance</label>
                                            <input type="text"name="balance" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="1">
                                <div class=" mt-1 mb-3 me-4">
                                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end">Send To Account
                                        Balance
                                    </button>
                                </div>
                            </form>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-12 mt-md-0 mt-4">
          <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mb-0">Your Transaction's</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                  <i class="material-icons me-2 text-lg">date_range</i>
                  <small>23 - 30 March 2020</small>
                </div>
              </div>
            </div>
            <div class="card-body pt-4 p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_more</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                      <span class="text-xs">27 March 2020, at 12:30 PM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                    - $ 2,500
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_less</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Apple</h6>
                      <span class="text-xs">27 March 2020, at 04:30 AM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 2,000
                  </div>
                </li>
              </ul>
              <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_less</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                      <span class="text-xs">26 March 2020, at 13:45 PM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 750
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_less</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">HubSpot</h6>
                      <span class="text-xs">26 March 2020, at 12:30 PM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 1,000
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_less</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Creative Tim</h6>
                      <span class="text-xs">26 March 2020, at 08:30 AM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 2,500
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">priority_high</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Webflow</h6>
                      <span class="text-xs">26 March 2020, at 05:00 AM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                    Pending
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('scripts')

@endsection