@extends('layout')

@section('content')
    <div id="header-featured">
        <div id="banner-wrapper">
            <div id="banner" class="container">
                <a href="#" class="button">
{{--                    @if (Auth::check())--}}
                    @auth()
                        Welcome, {{ Auth::user()->name }}
                    @else
                        Welcome
                    @endauth
                    @guest
                        Please Sign-in
                    @endguest
                </a>
            </div>
        </div>
    </div>
@endsection
