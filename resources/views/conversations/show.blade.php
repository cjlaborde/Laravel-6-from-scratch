@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>
                <a href="/conversations">Back</a>
                <h1>{{ $conversation->title }}</h1>

                <p class="text-muted">Posted By {{$conversation->user->name }}</p>

                <div>
                    {{$conversation->body}}
                </div>

                <hr>

                @include('conversations.replies')
            </p>
        </div>
    </div>
</div>
@endsection