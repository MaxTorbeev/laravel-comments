@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <ul class="posts">
                    <li><a href="{{ action('PostsController@show', ['id' => $post->id]) }}">{{ $post->title }}</a></li>
                </ul>
            @endforeach
        </div>
    </div>
@endsection
