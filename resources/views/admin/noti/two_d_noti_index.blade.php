@extends('layouts.admin_app')

@section('content')
@if(auth()->user()->is_admin)
    @forelse($notifications as $notification)
        <div class="alert alert-success" role="alert">
            User {{ $notification->data['message'] }} Account ID <strong style="color: aliceblue">
            ({{ $notification->data['user_id'] }}) 
            </strong> has just played two D [({{ $notification->created_at }})].
            <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                Mark as read
            </a>
        </div>

        @if($loop->last)
            <a href="#" id="mark-all">
                Mark all as read
            </a>
        @endif
    @empty
        There are no new notifications
    @endforelse
@endif
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @if(auth()->user()->is_admin)
    <script>
     let _token = $('meta[name="csrf-token"]').attr('content');
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('admin.playTwoDmarkNotification') }}", {
            method: 'POST',
            data: {
                _token,
                id
            }
        });
    }

    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));

            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });

        $('#mark-all').click(function() {
            let request = sendMarkRequest();

            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
    </script>
@endif
@endsection