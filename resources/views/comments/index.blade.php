<div class="media">
    <div class="media-left">
        <a href="#">
            <img class="media-object" src="holder.js/64x64" alt="...">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading">
            {{ $comment->user->name }}
            <small class="pull-right text-right" data-commet-id="{{ $comment->id }}">
                Карма:{{ $comment->karma }} <br>
                Вам помог комментарий:
                <a href="{{ route('comments.vote', ['id' => $comment->id]) }}?vote=yes">да</a>
                <a href="{{ route('comments.vote', ['id' => $comment->id]) }}?vote=no">нет</a>
            </small>
        </h4>
        id: {{ $comment->id }}<br>
        parent_id: {{ $comment->parent_id }}<br>
        {{ $comment->content }}
        @if(Auth::check())
            <div> <a href="#" class="replayComment" data-replay-level="{{ $comment->level + 1 }}" data-replay-comment-id="{{ $comment->id }}">reply</a> </div>
        @endif
        @if (count($comment->childrenRecursive) > 0)
            @foreach($comment->childrenRecursive as $comment)
                @include('comments.index', $comment)
            @endforeach
        @endif
    </div>
</div>
