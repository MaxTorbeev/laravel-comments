@extends('layouts.app')

@section('content')
    <h1>Write a New Post</h1>

    @include ('errors.list')
    {!! Form::model($posts = new \App\Post, ['url' => 'posts', 'files' => true]) !!}
        @include ('posts.form', ['submitButtonText' => 'Create post' ])
    {!! Form::close() !!}
@stop

@section('footer')

@stop