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

    .custom-form-group {
        margin-bottom: 20px;
    }

    .custom-form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .custom-form-group input,
    .custom-form-group select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #e1e1e1;
        border-radius: 5px;
        font-size: 16px;
        color: #333;
    }

    .custom-form-group input:focus,
    .custom-form-group select:focus {
        border-color: #d33a9e;
        box-shadow: 0 0 5px rgba(211, 58, 158, 0.5);
    }

    .submit-btn {
        background-color: #d33a9e;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
    }

    .submit-btn:hover {
        background-color: #b8328b;
    }
</style>
@endsection
@section('content')
<div class="row mt-4">
    
    <div class="col-12">
         

         <div class="card mt-3">
            <!-- Card header -->
            <div class="card-header pb-0">
                <div>
                    <h5 class="mb-0">3D ပတ်လယ်ပေါက်သူများ
                    
                    </h5>
                </div>
                <div class="card-header pb-0">
                 <form action="{{ route('admin.PostSecondPrizeWinners') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">3D ပတ်လယ်ပေါက်သူများသိမ်းရန်</button>
                    </form>
                </div>
                <div class="d-lg-flex mt-2">
                    <div class="ms-auto my-auto mt-lg-0">
                        <div class="ms-auto my-auto">
                        <form action="{{ route('admin.updateSecondwinners') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">3D Second Winner Update</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-flush" id="twod-search">
                    <thead class="thead-light">
                        <th>#</th>
                        <th>UserName</th>
                        <th>ထွက်ဂဏန်း</th>
                        <th>Sub_Amount</th>
                        <th>Prize</th>
                        <th>Status</th>
                        <th>Date</th>
                        {{-- <th>user_id</th> --}}
                    </thead>
                    <tbody>
                        @if($winners)
                        @foreach($winners as $key => $winner)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                             {{ $winner->name }}
                            <span class="badge-info">
                             {{ $winner->phone }}
                            </span>
                            </td>
                            <td>{{ $winner->bet_digit }}</td>
                            <td>{{ $winner->sub_amount }}</td>
                            <td>{{ $winner->sub_amount * 10 }}</td>
                            <td>
                            @if($winner->prize_sent == 2)
                                <span class="badge badge-primary">ပါတ်လယ်ရရှိသည်</span>
                            @else
                                <span class="badge badge-secondary">No Winner</span>
                            @endif
                            </td>

                            <td> {{ $winner->created_at }}</td>
                            {{-- <td> {{ $winner->user_id }}</td> --}}
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No Data Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-2">
         <div class="card-header">
          <h5>3D Second Prize Winner History</h5>
         </div>
          <div class="table-responsive">
                <table class="table table-flush" id="twod-search">
                    <thead class="thead-light">
                        <th>#</th>
                        <th>UserName</th>
                        <th>ထွက်ဂဏန်း</th>
                        <th>Sub_Amount</th>
                        <th>Prize</th>
                        <th>Status</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        @if($prizes)
                        @foreach($prizes as $key => $prize)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                             {{ $prize->user_name }}
                            <span class="badge-info">
                             {{ $prize->phone }}
                            </span>
                            </td>
                            <td>{{ $prize->bet_digit }}</td>
                            <td>{{ $prize->sub_amount }}</td>
                            <td>{{ $prize->prize_amount }}</td>
                            <td>
                            @if($prize->status == 2)
                                <span class="badge badge-primary">ပါတ်လယ်ရရှိသည်</span>
                            @else
                                <span class="badge badge-secondary">No Winner</span>
                            @endif
                            </td>
                            <td> {{ $prize->created_at }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No Data Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Total Prize Amount {{ $totalPrizeAmount }}</h5>
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    @if(session('SuccessRequest'))
    Swal.fire({
      icon: 'success',
      title: 'Success! Three Digit Lottery Prize Number Created Successfully',
      text: '{{ session('
      SuccessRequest ') }}',
      timer: 3000,
      showConfirmButton: false
    });
    @endif
  });
</script>
<script>
    if (document.getElementById('twod-search')) {
        const dataTableSearch = new simpleDatatables.DataTable("#twod-search", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
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
    };
</script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
<script>
    if (document.getElementById('search')) {
        const dataTableSearch = new simpleDatatables.DataTable("#search", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
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
    };
</script>
@endsection