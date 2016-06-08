@extends('layouts.app')

@section('content')

    <article class="article">
        @can('update', $post)
            <a href="{{ action('PostController@show', ['alias' => $post->alias]) }}/edit">Редактировать статью</a>
        @endcan

        <div class="row">
            <div class="col-md-5">
                @if($post->image)
                    <div class="article_imageFulltext mtn">
                        <a href="{{ asset('/images/articles/' . $post->id . '/' . $post->image) }}">
                            <img class="img-responsive" src="{{ asset('/images/post/' . $post->id . '/large_' . $post->image) }}" alt=""/>
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <h1 class="article_title">{{ $post->title }}</h1>
                <span>Published: {{ $post->user->name }}</span>

                <div class="article_introText mtn lead">
                    {{ $post->intro_text }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="article_body col-md-offset-2 col-md-8 mtl">
                {!! $post->body !!}
            </div>
        </div>
    </article>

    <div class="panel panel-default">
        <div class="panel-heading">Comments</div>
        <div class="panel-body">
            @each('comments.index', $comments, 'comment', 'comments.comments-none')
        </div>
    </div>

    @if(Auth::check())
        <h4>Add comment</h4>
       @include('comments.create')
    @endif

@stop

@section('footer')

    <script>
        function form(tag){
            var replayId = $(tag).data('replay-comment-id'),
                level = $(tag).data('replay-level');

            return '<form class="comment-form" action=" {{ route("comments.store") }}" method="POST">' +
                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                    '<textarea class="form-control" rows="3" name="content" cols="50" id="content"></textarea>' +
                    '<input type="hidden" name="post_id" value="{{ $post->id }}">' +
                    '<input type="hidden" name="level" value="' + level + '">' +
                    '<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">' +
                    '<input type="hidden" name="parent_id" value="' + replayId + '">' +
                    '<input type="submit" value="comment">' +
                    '</form>'
        }

        $('.replayComment').on('click', function(e){
            e.preventDefault();
            if ($(this).siblings().hasClass('comment-form') == false) {
                $(this).parent().append(form(this));
            }
        });
    </script>
@stop