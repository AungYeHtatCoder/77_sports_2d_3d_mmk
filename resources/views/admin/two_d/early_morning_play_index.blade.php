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
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">2D - 9:30 Morning Session Dashboards</h5>

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
                    <table class="table table-flush" id="users-search">
                        <thead class="thead-light">
                            <tr>
                                <th>Lottery ID</th>
                                <th>PlayerName</th>
                                <th>Two Digits</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through each lottery -->
                            @foreach ($lotteries as $lottery)
                                <tr>
                                    <td>{{ $lottery->id }}</td>
                                    <td>{{ $lottery->user->name }}</td>
                                    <!-- Assuming there's a relation from Lottery to User -->
                                    <td>
                                        <ul>
                                            @foreach ($lottery->twoDigits as $twoDigit)
                                                <li>
                                                    {{ $twoDigit->two_digit }} Amount: {{ $twoDigit->pivot->sub_amount }} -
                                                    {{ $twoDigit->pivot->created_at->format('d M Y (l) (h:i a)') }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($lottery->twoDigitsMorning as $twoDigit)
                                                <li>

                                                    <!-- Check if it's a winner -->
                                                    @if ($prize_no_morning && $twoDigit->two_digit === $prize_no_morning->prize_no)
                                                        <span class="badge badge-success">WINNER</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

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
    <script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
    {{-- <script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: true
    });
  </script> --}}
    <script>
        if (document.getElementById('users-search')) {
            const dataTableSearch = new simpleDatatables.DataTable("#users-search", {
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
