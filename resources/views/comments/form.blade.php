<div class="form-group">
    {!! Form::label('content', 'Comment content:') !!}
    {!! Form::textarea('content', null, ['class'=>'form-control', 'rows'=>'3']) !!}
</div>

{!! Form::input('hidden', 'user_id', Auth::user()->id, ['class'=>'form-control' ]) !!}
{!! Form::input('hidden', 'post_id', $post->id, ['class'=>'form-control' ]) !!}
{{--{!! Form::input('hidden', 'parent_id', 0, ['class'=>'form-control' ]) !!}--}}

<div class="form-group">
    {!! Form::submit( $submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>