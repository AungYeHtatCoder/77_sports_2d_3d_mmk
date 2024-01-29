@extends('layouts.admin_app')
@section('styles')
<style>
.transparent-btn {
 background: none;
 border: none;
 padding: 0;
 outline: none;
 cursor: pointer;
 box-shadow: none;
 appearance: none;
 /* For some browsers */
}
</style>
@endsection
@section('content')
<div class="d-sm-flex justify-content-between">
        <div>
          <a href="javascript:;" class="btn btn-icon bg-gradient-primary">
            User Balance Withdraw Dashboard
          </a>
        </div>
        <div class="d-flex">
          <div class="dropdown d-inline">
            <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
              Filters
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-start">
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Paid</a></li>
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Refunded</a></li>
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Canceled</a></li>
              <li>
                <hr class="horizontal dark my-2">
              </li>
              <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove Filter</a></li>
            </ul>
          </div>
          <button class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" type="button">
            <i class="material-icons text-xs position-relative">archive</i>
            Export CSV
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Balance Access Dashboard</h5>
              <p class="text-sm mb-0">
                {{-- View all the orders from the previous year. --}}
              </p>
            </div>
            <div class="table-responsive">
              <table class="table table-flush" id="datatable-search">
                <thead class="thead-light">
                  <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Customer</th>
                    <th>WithdrawNo</th>
                    <th>RecieveNo</th>
                    <th>Show</th>
                    {{-- <th>SendBalance</th> --}}
                  </tr>
                </thead>
                <tbody>
                 @foreach($balance_requests as $balance)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="customCheck1">
                        </div>
                        <p class="text-xs font-weight-normal ms-2 mb-0"># {{ $balance->id }}</p>
                      </div>
                    </td>
                    <td class="font-weight-normal">
                      <span class="my-2 text-xs">{{ $balance->created_at->format('j M, H:i A') }}</span>
                    </td>
<td class="text-xs font-weight-normal">
    <div class="d-flex align-items-center">
        @if($balance->status == 'accept')
            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center">
                <i class="material-icons text-sm" aria-hidden="true">done</i>
            </button>
            <span>Accept</span>
        @elseif($balance->status == 'reject')
            <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center">
                <i class="material-icons text-sm" aria-hidden="true">close</i>
            </button>
            <span>Reject</span>

        @else
            <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center">
                <i class="material-icons text-sm" aria-hidden="true">close</i>
            </button>
            <span>Pending</span>
        @endif
        <form action="{{ route('admin.withdrawViewUpdate', $balance->id) }}" method="post" class="d-flex align-items-center ml-3">
            @csrf
            @method('PUT')
            <select id="choices-category-edit" name="status" onchange="this.form.submit()">
                <option value="pending" {{ $balance->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="accept" {{ $balance->status == 'accept' ? 'selected' : '' }}>Accept</option>
                <option value="reject" {{ $balance->status == 'reject' ? 'selected' : '' }}>Reject</option>
            </select>
        </form>
    </div>
</td>


                    <td class="text-xs font-weight-normal">
                      <div class="d-flex align-items-center">
                        {{-- <img src="{{ $balance->user->profile }}" class="avatar avatar-xs me-2" alt="user image"> --}}
                        <span>{{ $balance->user->name }}</span>
                      </div>
                    </td>
                    <td class="text-xs font-weight-normal">
                      <span class="my-2 text-xs">{{ $balance->user_ph_no }}</span>
                    </td>
                    <td class="text-xs font-weight-normal">
                     {{-- @php
                       $paymentMethods = ['kpay_no', 'cbpay_no', 'wavepay_no', 'ayapay_no'];
                   @endphp
                   @foreach ($paymentMethods as $method)
                       @if($balance->{$method})
                           <span class="my-2 text-xs">{{ $balance->{$method} }}</span>
                           @break
                       @endif
                   @endforeach --}}
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

                    </td>
                    <td class="text-xs font-weight-normal">
                      {{-- go to show page --}}
                      <a href="{{ route('admin.withdrawViewDetails', $balance->id) }}" class="btn btn-icon btn-outline-dark btn-sm">
                        <i class="material-icons">remove_red_eye</i>
                      </a>
                    </td>
                    {{-- <td class="text-xs font-weight-normal">
                      <a href="{{ route('admin.fill-balance-replies.edit', $balance->id) }}" class="btn btn-icon btn-outline-dark btn-sm">
                        <i class="material-icons">send</i>
                      </a>
                    </td> --}}
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('scripts')
  {{-- <script src="{{ asset('admin_app/assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/quill.min.js') }}"></script> --}}

<script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
<script>
 // if (document.getElementById('choices-category-edit')) {
 //      var element = document.getElementById('choices-category-edit');
 //      const example = new Choices(element, {
 //        searchEnabled: false
 //      });
 //    };

 const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

    document.querySelectorAll(".export").forEach(function(el) {
      el.addEventListener("click", function(e) {
        var type = el.dataset.type;

        var data = {
          type: type,
          filename: "material-" + type,
        };

        if (type === "csv") {
          data.columnDelimiter = "|";
        }

        dataTableSearch.export(data);
      });
    });
  </script>

<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
 return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
@endsection