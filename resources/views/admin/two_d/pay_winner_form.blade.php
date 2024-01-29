<td>
    @if (!$twoDigit->pivot->prize_sent)
        <form action="{{ route('admin.tow-d-morning-number.update', $lottery->id) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="lottery_id" value="{{ $lottery->id }}">
            <input type="hidden" name="two_digit_id" value="{{ $twoDigit->id }}">
            <input type="hidden" name="amount" value="{{ $twoDigit->pivot->sub_amount * 85 }}">
            <button type="submit" class="btn btn-success">Send</button>
        </form>
    @else
        <button type="button" class="btn btn-success" disabled>Sent</button>
    @endif
</td>
