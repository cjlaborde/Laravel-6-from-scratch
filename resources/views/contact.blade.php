@extends('layout')

@section('content')
    <div id="page" class="container">
        <div class="flex justify-center">
            <form
                method="POST"
                action="/contact"
                class="p-6 shadow-md items-center"
                style="width: 300px"
            >
                @csrf
                <div class="mb-3">
                    <label
                        for="email"
                        class="block text-xs uppercase font-semibold mb-1"
                    >
                        Email Address
                    </label>

                    <input
                        type="text"
                        id="email"
                        name="email"
                        class="border w-full text-sm"
                    >
                    @error('email')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 w-full rounded-full"
                >
                    Email Us
                </button>

                <!-- Look in session do we have anything from that flash message? -->
                @if (session('message'))
                    <p class="text-green-500 text-xs">
                        <!-- if so output the message -->
                        {{{ session('message') }}}
                    </p>
                @endif
            </form>
        </div>
    </div>
@endsection
