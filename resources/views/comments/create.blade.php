{!! Form::model($comment = new App\Models\Comments\Comment, ['url' => 'comments']) !!}
    @include ('comments.form', ['submitButtonText' => 'Add comment' ])
{!! Form::close() !!}