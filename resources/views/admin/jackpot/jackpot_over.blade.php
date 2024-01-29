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

@font-face {
    font-family: 'Myanmar Pyidaungsu';
    src: url('{{ asset('assets/css/Pyidaungsu.ttf') }}') format('truetype');
    font-weight: normal;
    font-style: normal;
}

.table-font-myanmar {
    font-family: 'Pyidaungsu', sans-serif;
}
</style>

@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">အောက်နှစ်လုံးထီ Over Amount Limit Dashboards
                                <span>
                                     <h6>အောက်နှစ်လုံးထီ Lottery Match Times for {{ Carbon\Carbon::now()->format('F Y') }}</h6>
                                </span>
                            </h5>

                        </div>
                       
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                {{-- <a href="{{ route('admin.users.create') }}"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Create New
                                    User</a> --}}
                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                    type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
   <div class="table-responsive">
       <table class="table table-flush" id="twod-search">
           <thead class="thead-light">
               <th>#</th>
               {{-- <th>Lottery ID</th> --}}
               <th>Name</th>
               <th>3D</th>
               
               <th>Date</th>
              
           </thead>
           <tbody>
     @foreach ($lotteries as $lottery)
         <tr>
             <td class="text-sm font-weight-normal">{{ $lottery->id }}</td>
             <td class="text-sm font-weight-normal">
                 <span class="badge badge-secondary">{{ $lottery->user->name }}</span>
             </td>
             
             <td class="text-sm font-weight-normal">
                 <ul class="navbar-nav">
                     @foreach ($lottery->DisplayJackpotDigitsOver as $jackpot_Digit)
                         <li class="nav-item">
                             <button type="button" class="btn btn btn-primary">
                                 <span>{{ $jackpot_Digit->two_digit }} </span>
                                 <span class="badge badge-pill badge-lg bg-gradient-success table-font-myanmar">
                                  Amount &nbsp; &nbsp; - {{ $jackpot_Digit->pivot->sub_amount }} || &nbsp; &nbsp;</span>
                             </button>
                         </li>
                     @endforeach
                 </ul>
             </td>
             
             <td class="text-sm font-weight-normal">

                 <span
                     class="badge bg-gradient-info">{{ $lottery->created_at->format('d-m-Y (l) (h:i a)') }}</span>
             </td>
             
         </tr>
         <hr class="mt-2">
     @endforeach
           </tbody>
       </table>
   </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
    {{-- <script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: true
    });
  </script> --}}
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
                        data.columnDelimiter = ",";
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
@endsection
