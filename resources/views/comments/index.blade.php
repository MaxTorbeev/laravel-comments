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
                {{ $comment->commentVote->vote }}
                Vote:{{ $comment->vote }} <br>
                Вам помог комментарий:
                <a href="{{ route('comments.vote', ['id' => $comment->id]) }}?vote=yes">да</a>
                <a href="{{ route('comments.vote', ['id' => $comment->id]) }}?vote=no">нет</a>
            </small>
        </h4>
        id: {{ $comment->id }}<br>
        parent_id: {{ $comment->parent_id }}<br>
        <div class="comment-body">
            {{ $comment->content }}
        </div>
        @if(Auth::check())
        <a href="{{ route('comments.store') }}" class="replayComment" data-comment-level="{{ $comment->level + 1 }}" data-comment-parent-id="{{ $comment->id }}">reply</a>
        <a href="{{ route('comments.update', ['id' => $comment->id]) }}" data-comment-level="{{ $comment->level }}" class="updateComment" data-comment-parent-id="{{ $comment->parent_id }}">edit</a>
        <a href="{{ route('comments.destroy', ['id' => $comment->id]) }}" class="deleteComment">delete</a>
        @endif
        @if (count($comment->childrenRecursive) > 0)
            @foreach($comment->childrenRecursive as $comment)
                @include('comments.index', $comment)
            @endforeach
        @endif
    </div>
</div>
