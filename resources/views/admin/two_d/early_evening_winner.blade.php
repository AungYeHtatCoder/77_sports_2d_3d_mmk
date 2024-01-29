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
                            <h5 class="mb-0">2D Early Evening Winner Dashboards - 12PM-2:30PM
                                <span>
                                    <button type="button" class="btn btn-primary">
                                        @if ($prize_no_afternoon)
                                            <span>{{ $prize_no->created_at->format('d-m-Y (l) (h:i a)') }}</span>
                                            <span class="badge badge-warning"
                                                style="font-size: 15px; color:white">{{ $prize_no->prize_no }}</span>
                                        @else
                                            <span>No Prize Number Yet</span>
                                        @endif
                                    </button>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="users-search">
                        <thead class="thead-light">
                            <th>PlayerName</th>
                            <th>Winning Two Digits</th>
                            <th>Bet Amount</th>
                            <th>12PM - 2:30 PM</th>
                            <th>Prize Amount</th>
                            <th>SendToAccBalance</th>
                        </thead>
                        <tbody>
                            <!-- Loop through each lottery -->
@foreach ($lotteries as $lottery)
    <!-- Loop through each two digits for the lottery -->
    @foreach ($lottery->twoDigitsEvening as $twoDigit)
        <!-- Check if it's a winner -->
        @if ($prize_no_afternoon && $twoDigit->two_digit == $prize_no_afternoon->prize_no)
            <tr>
                <td>{{ $lottery->user->name }}</td>
                <td>{{ $twoDigit->two_digit }}</td>
                <td>{{ $twoDigit->pivot->sub_amount }}</td>
                <td><span class="badge badge-success">WINNER</span></td>
                <td>{{ $twoDigit->pivot->sub_amount * 85 }}</td>
                <td>
                                                                    @if ($twoDigit->pivot->prize_sent == 1)
                                                    <button type="button" class="btn btn-success" disabled>Sent - လျော်ပြီး</button>
                                                @else
                                                    <button type="button" class="btn btn-danger" disabled>Not Send
                                                        {{ $twoDigit->pivot->prize_sent }}</button>
                                                @endif
                </td>
            </tr>
                @endif
            
    @endforeach
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
