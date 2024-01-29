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

<div class="container-fluid my-3 py-3">
 <div class="row mb-5">
  <div class="col-lg-3 position-sticky col-md-6">
   <div class="card  top-1 mb-3">
    <div class="card-header mx-4 p-3 text-center">
     <div class="avatar avatar-xl position-relative">
      <img src="{{ asset('admin_app/assets/img/team-3.jpg') }}" alt="bruce" class="w-100 rounded-circle shadow-sm">
     </div>
    </div>
    <div class="card-body pt-0 p-3 text-center">
     <div class="input-group input-group-outline">
      <input type="file" class="form-control">
     </div>
     <!-- <span class="text-xs">Freelance Payment</span> -->
     <hr class="horizontal dark mt-2">
     <button class="btn bg-gradient-dark btn-sm float-center">Upload
     </button>
    </div>
   </div>
   <div class="card top-1">
    <div class="card-header mx-4 p-3 text-center">
     <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
      <i class="material-icons opacity-10">account_balance_wallet</i>
     </div>
    </div>
    <div class="card-body pt-0 p-3 text-center">
     <h6 class="text-center mb-0">Total Balance</h6>
     <!-- <span class="text-xs">Freelance Payment</span> -->
     <hr class="horizontal dark my-3">
     <h5 class="mb-0">$455.00</h5>
    </div>
   </div>

  </div>
  <div class="col-lg-9 mt-lg-0 mt-4">
   <!-- Card Profile -->
   <div class="card card-body" id="profile">
    <div class="row justify-content-center align-items-center">
     <div class="col-sm-auto col-4">
      <div class="avatar avatar-xl position-relative">
       <img src="{{ asset('admin_app/assets/img/team-3.jpg') }}" alt="bruce" class="w-100 rounded-circle shadow-sm">
      </div>
     </div>
     <div class="col-sm-auto col-8 my-auto">
      <div class="h-100">
       <h5 class="mb-1 font-weight-bolder">
        Richard Davis
       </h5>
       <p class="mb-0 font-weight-normal text-sm">
        CEO / Co-Founder
       </p>
      </div>
     </div>
     <!-- <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
      <a class="btn btn-icon btn-3 btn-primary" href="{{ url('/admin/profile/fill_money') }}">

       <span class="btn-inner--icon"><i class="material-icons">play_arrow</i></span>
       <span class="btn-inner--text">Fill Money</span>
      </a>
     </div> -->
    </div>
   </div>
   <!-- Card Basic Info -->
   <div class="row">
    <div class="col-lg-6">
     <div class="card mt-4" id="basic-info">
      <div class="card-header">
       <h5>Basic Info</h5>
      </div>
      <div class="card-body pt-0">
       <div class="row">
        <div class="input-group input-group-static">
         <label>Name</label>
         <input type="text" class="form-control" placeholder="Alec">
        </div>
       </div>
       <div class="row mt-3">
        <div class="input-group input-group-static">
         <label>Email</label>
         <input type="email" class="form-control" placeholder="example@email.com">
        </div>
       </div>
       <div class="row mt-3">
        <div class="input-group input-group-static">
         <label>Address</label>
         <input type="text" class="form-control" placeholder="Sydney, A">
        </div>
       </div>
       <div class="row mt-3">
        <div class="input-group input-group-static">
         <label>Phone Number</label>
         <input type="number" class="form-control" placeholder="+40 735 631 620">
        </div>
       </div>
      </div>
      <div class=" mt-1 mb-3 me-4">
       <button class="btn bg-gradient-dark btn-sm float-end">Update Profile
       </button>
      </div>

     </div>
    </div>
    <div class="col-lg-6">
     <div class="card mt-4" id="password">
      <div class="card-header">
       <h5>Change Password</h5>
      </div>
      <div class="card-body pt-0">
       <div class="input-group input-group-outline">
        <label class="form-label">Current password</label>
        <input type="password" class="form-control">
       </div>
       <div class="input-group input-group-outline my-4">
        <label class="form-label">New password</label>
        <input type="password" class="form-control">
       </div>
       <div class="input-group input-group-outline">
        <label class="form-label">Confirm New password</label>
        <input type="password" class="form-control">
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
       <button class="btn bg-gradient-dark btn-sm float-end mb-0">Update password</button>
      </div>
     </div>
    </div>
   </div>

   <!-- Card Change Password -->

   <!-- Card Change Password -->

   <!-- Card Accounts -->
   <div id="accounts">
    <div class="row mt-3">
     <div class="col-lg-12 col-12">
      <div class="row">
       <div class="mb-4 ms-3">
        <h5>Accounts</h5>
       </div>
       <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0 mb-2 mb-md-0">
        <div class="card">
         <div class="card-header p-3 pt-2">
          <div class="image-container ms-3 border-radius-xl mt-n4 position-absolute">
           <img src="{{ asset('admin_app/assets/img/bank_acc_icon/kpay.png') }}" class="image img-fluid">
          </div>
          <div class="text-end pt-1 me-3">
           <p class="text-sm mb-0 text-capitalize">User Name</p>
           <h5 class="mb-0">
            091234567
           </h5>
          </div>
         </div>
         <hr class="dark horizontal my-0">
         <div class="card-footer p-3">
          <a href="{{ url('/admin/profile/fill_money') }}" class="text-primary text-sm icon-move-right my-auto">Fill
           Money
           <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
          </a>
         </div>
        </div>
       </div>
       <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0 mb-2 mb-md-0">
        <div class="card">
         <div class="card-header p-3 pt-2">
          <div class="image-container ms-3 border-radius-xl mt-n4 position-absolute">
           <img src="{{ asset('admin_app/assets/img/bank_acc_icon/wpay.png') }}" class="image img-fluid">
          </div>
          <div class="text-end pt-1 me-3">
           <p class="text-sm mb-0 text-capitalize">User Name</p>
           <h5 class="mb-0">
            091234567
           </h5>
          </div>
         </div>
         <hr class="dark horizontal my-0">
         <div class="card-footer p-3">
          <a href="{{ url('/admin/profile/fill_money') }}" class="text-primary text-sm icon-move-right my-auto">Fill
           Money
           <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
          </a>
         </div>
        </div>
       </div>
      </div>

      <div class="row mt-5">
       <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0 mb-2 mb-md-0">
        <div class="card">
         <div class="card-header p-3 pt-2">
          <div class="image-container ms-3 border-radius-xl mt-n4 position-absolute">
           <img src="{{ asset('admin_app/assets/img/bank_acc_icon/cbpay.png') }}" class="image img-fluid">
          </div>
          <div class="text-end pt-1 me-3">
           <p class="text-sm mb-0 text-capitalize">User Name</p>
           <h5 class="mb-0">
            091234567
           </h5>
          </div>
         </div>
         <hr class="dark horizontal my-0">
         <div class="card-footer p-3">
          <a href="{{ url('/admin/profile/fill_money') }}" class="text-primary text-sm icon-move-right my-auto">Fill
           Money
           <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
          </a>
         </div>
        </div>
       </div>
       <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0 mb-2 mb-md-0">
        <div class="card">
         <div class="card-header p-3 pt-2">
          <div class="image-container ms-3 border-radius-xl mt-n4 position-absolute">
           <img src="{{ asset('admin_app/assets/img/bank_acc_icon/cblogo.png') }}" class="image img-fluid">
          </div>
          <div class="text-end pt-1 me-3">
           <p class="text-sm mb-0 text-capitalize">User Name</p>
           <h5 class="mb-0">
            091234567
           </h5>
          </div>
         </div>
         <hr class="dark horizontal my-0">
         <div class="card-footer p-3">
          <a href="{{ url('/admin/profile/fill_money') }}" class="text-primary text-sm icon-move-right my-auto">Fill
           Money
           <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
          </a>
         </div>
        </div>
       </div>
      </div>
      <div class="row mt-5">
       <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0 mb-2 mb-md-0">
        <div class="card">
         <div class="card-header p-3 pt-2">
          <div class="image-container ms-3 border-radius-xl mt-n4 position-absolute">
           <img src="{{ asset('admin_app/assets/img/bank_acc_icon/aya_logo.png') }}" class="image img-fluid">
          </div>
          <div class="text-end pt-1 me-3">
           <p class="text-sm mb-0 text-capitalize">User Name</p>
           <h5 class="mb-0">
            091234567
           </h5>
          </div>
         </div>
         <hr class="dark horizontal my-0">
         <div class="card-footer p-3">
          <a href="{{ url('/admin/profile/fill_money') }}" class="text-primary text-sm icon-move-right my-auto">Fill
           Money
           <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
          </a>
         </div>
        </div>
       </div>
       <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0 mb-2 mb-md-0">
        <div class="card">
         <div class="card-header p-3 pt-2">
          <div class="image-container ms-3 border-radius-xl mt-n4 position-absolute">
           <img src="{{ asset('admin_app/assets/img/bank_acc_icon/aya pay.png') }}" class="image img-fluid">
          </div>
          <div class="text-end pt-1 me-3">
           <p class="text-sm mb-0 text-capitalize">User Name</p>
           <h5 class="mb-0">
            091234567
           </h5>
          </div>
         </div>
         <hr class="dark horizontal my-0">
         <div class="card-footer p-3">
          <a href="{{ url('/admin/profile/fill_money') }}" class="text-primary text-sm icon-move-right my-auto">Fill
           Money
           <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
          </a>
         </div>
        </div>
       </div>
      </div>
      <div class="row mt-5">
       <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0 mb-2 mb-md-0">
        <div class="card">
         <div class="card-header p-3 pt-2">
          <div class="image-container ms-3 border-radius-xl mt-n4 position-absolute">
           <img src="{{ asset('admin_app/assets/img/bank_acc_icon/kbz.png') }}" class="image img-fluid">
          </div>
          <div class="text-end pt-1 me-3">
           <p class="text-sm mb-0 text-capitalize">User Name</p>
           <h5 class="mb-0">
            091234567
           </h5>
          </div>
         </div>
         <hr class="dark horizontal my-0">
         <div class="card-footer p-3">
          <a href="{{ url('/admin/profile/fill_money') }}" class="text-primary text-sm icon-move-right my-auto">Fill
           Money
           <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
          </a>
         </div>
        </div>
       </div>
       <!-- <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0 mb-2 mb-md-0">
        <div class="card">
         <div class="card-header p-3 pt-2">
          <div class="image-container ms-3 border-radius-xl mt-n4 position-absolute">
           <img src="{{ asset('admin_app/assets/img/bank_acc_icon/wpay.png') }}" class="image img-fluid">
          </div>
          <div class="text-end pt-1 me-3">
           <p class="text-sm mb-0 text-capitalize">User Name</p>
           <h5 class="mb-0">
            091234567
           </h5>
          </div>
         </div>
         <hr class="dark horizontal my-0">
         <div class="card-footer p-3">
          <a href="{{ url('/admin/profile/fill_money') }}" class="text-primary text-sm icon-move-right my-auto">Fill
           Money
           <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
          </a>
         </div>
        </div>
       </div> -->
      </div>
     </div>
    </div>
   </div>

   <!-- Card Delete Account -->
   <div class="card mt-4" id="delete">
    <div class="card-body">
     <div class="d-flex align-items-center mb-sm-0 mb-4">
      <div class="w-50">
       <h5>Delete Account</h5>
       <p class="text-sm mb-0">Once you delete your account, there is no going back. Please be certain.</p>
      </div>
      <div class="w-50 text-end">
       <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button" name="button">Deactivate</button>
       <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Delete Account</button>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection