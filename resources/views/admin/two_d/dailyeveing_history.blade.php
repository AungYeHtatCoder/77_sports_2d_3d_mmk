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
                            <h5 class="mb-0">2D - 4:30 စာရင်း ပေါင်းချုပ် -   Dashboards
                                <span>
                                     <h6>
                                      {{-- today date and time with js --}}
                                      <span id="date_time"></span>
                                      <script type="text/javascript">window.onload = date_time('date_time');</script>

                                     </h6>
                                </span>
                                <span>
                                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                
                                <a class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1"
                                    href="{{ url('/admin/tow-d-morning-number') }}" >Back</a>
                            </div>
                        </div>
                                </span>
                            </h5>

                        </div>
                       
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                
                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                    type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
   <div class="table-responsive">
   
       <table class="table table-flush" id="twod-search">
           <thead class="thead-light">
                <tr>
                <th>No</th>
                <th>==</th>
                {{-- <th>Phone</th> --}}
                <th>2D</th>
                <th>ထိုးကြေး</th>
                <th>ရက်စွဲ</th>
                <th>Win/Lose</th>
                </tr>
           </thead>
            <tbody>
        @if(isset($displayTwoDigits) && count($displayTwoDigits) == 0)
        <p class="text-center text-white px-3 py-2 mt-3" style="background-color: #c50408">
        ကံစမ်းထားသော 2D ထီဂဏန်းများ မရှိသေးပါ
        </p>
        @endif

        @if($displayTwoDigits)
        @foreach ($displayTwoDigits as $index => $digit)
         <tr>
           <td>{{ $index + 1 }}</td>
           <td><p>===</p></td>
           {{-- <td>{{ $digit->phone }}</td> --}}
           <td>{{ $digit->two_digit }}</td>
           <td>
            @if($digit->pivot->sub_amount >= $twod_limits->two_d_limit)
            <span class="text-danger">
          {{ $digit->pivot->sub_amount }}
            </span>
            @else
            <p class="text-info">
          {{ $digit->pivot->sub_amount }}
            </p>
            @endif
           </td>
           <td class="text-sm font-weight-normal">
            <span
             class="badge bg-gradient-info">{{ $digit->created_at->format('d-m-Y (l) (h:i a)') }}</span>
           </td>
           <td>
            @if ($digit->pivot->prize_sent == 1)
             <span class="text-success">Win</span>
            @else
             <span class="text-danger">Pending</span>
            @endif
           </td>
         </tr>
         @endforeach
        @endif
      </tbody>
       </table>
        <div class="mb-3 d-flex justify-content-around text-white p-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p class="text-end pt-1" style="color: #fff">Total Amount : ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
        <strong>{{ $total_amount }} MMK</strong>
      </p>
    </div>
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
