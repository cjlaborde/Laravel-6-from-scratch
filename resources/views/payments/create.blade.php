@extends('layout')

@section('content')
    <div id="page" class="container">
        <form method="POST" action="/payments">
            @csrf
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Make Payment
            </button>
        </form>
    </div>
@endsection
