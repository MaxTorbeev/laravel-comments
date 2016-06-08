{!! Form::model($comment = new \App\Comment, ['url' => 'comments']) !!}
    @include ('comments.form', ['submitButtonText' => 'Add comment' ])
{!! Form::close() !!}