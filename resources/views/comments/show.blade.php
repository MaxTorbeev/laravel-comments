<div class="media">
    <div class="media-left">
        {{ $comment->id }}
        <a href="#">
            <img class="media-object" src="holder.js/64x64" alt="...">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading">{{ $comment->user->name }}</h4>
        {{ $comment->content }}
        @if(Auth::check())
            <div> <a href="#" class="replayComment" data-replay-comment-id="{{ $comment->id }}">reply</a> </div>
        @endif
    </div>
</div>