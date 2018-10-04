@extends('main')

@section('title','|Edit Comment')
@section('stylesheets')
{!!Html::style('css/select2.min.css')!!}

@endsection
@section('content')
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
{{Form::model($comment,['route'=>['comments.update',$comment->id]])}}
{{method_field('PUT')}}

{{Form::label('name','Name:')}}
{{Form::text('name','null',['class'=>'form-control','disabled'=>'disabled'])}}

{{Form::label('email','Email:')}}
{{Form::text('email','null',['class'=>'form-control','disabled'=>'disabled'])}}

{{Form::label('comment','Comment:')}}
{{Form::textarea('comment','null',['class'=>'form-control'])}}
{{Form::submit('Update Comment',['class'=>'btn btn-block btn-success','style'=>'margin-top:15px;'])}}
{{Form::close()}}
    </div>
</div>
@endsection 
