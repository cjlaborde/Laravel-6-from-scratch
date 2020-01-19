@extends ('layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
{{--        @foreach ($articles as $article) with forelse is same as foreach but also include if statement--}}
            @forelse ($articles as $article)
                <div id="content">
                    <div class="title">
                        <h2>
{{--                            <a href="{{ route('articles.show', $article->id)}}">--}}
{{--                            <a href="{{ route('articles.show', $article )}}">--}}
                            <a href="{{ $article->path() }}">
                                {{ $article->title }}
                            </a>
                        </h2>
                        <span class="byline">{{ $article->excerpt }}</span> </div>
                    <p><img src="/images/banner.jpg" alt="" class="image image-full" /></p>
{{--                    {{ $article->body }}--}}
                </div>
            @empty
                <p>No revelant articles yet.</p>
            @endforelse
        </div>
    </div>
@endsection
