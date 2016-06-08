<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('alias', 'Alias:') !!}
            {!! Form::text('alias', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            {!! Form::label('intro_text', 'Intro text:') !!}
            {!! Form::textarea('intro_text', null, ['class'=>'form-control', 'rows'=>'3', ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control', 'id'=>'editor']) !!}
        </div>
    </div>

    <div class="col-sm-4">

        <div class="form-group">
            {!! Form::label('Article full text image') !!}
            {!! Form::file('image', null) !!}
        </div>

        <div class="form-group">
            {!! Form::label('metadesc', 'meta-description:') !!}
            {!! Form::input('text', 'metadesc', null, ['class'=>'form-control' ]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('metakey', 'meta-keywords:') !!}
            {!! Form::input('text', 'metakey', null, ['class'=>'form-control' ]) !!}
        </div>

    </div>
</div>


<div class="form-group">
    {!! Form::submit( $submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>


@section('footer')

    {{--<script type="text/javascript" src="{!! asset('build/media/ckeditor/ckeditor.js') !!}"></script>--}}

    {{--<script>--}}
        {{--CKEDITOR.replace('body',{--}}
            {{--filebrowserBrowseUrl : '/elfinder/ckeditor'--}}
        {{--});--}}

    {{--</script>--}}

@endsection