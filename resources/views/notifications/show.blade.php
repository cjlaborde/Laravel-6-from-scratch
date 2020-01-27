@extends('layout')

@section('content')
    <div id="page" class="container">
        <ul>
            @forelse($notifications as $notification)
            <li>
                @if ($notification->type === 'App\Notifications\PaymentReceived')
                    We have received a payment of ${{ $notification->data['amount'] / 100 }} from you.
                @endif
            </li>
            @empty

                <li>You have no unread notification as this time.</li>
            @endforelse
        </ul>
    </div>
@endsection

