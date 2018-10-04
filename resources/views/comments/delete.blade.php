@extends('main')

@section('title','|Delete Comment?')

@section('content')
<div class="row">
    <div class="col-md-8col-md-offset-2">
        <h1>Are you sure to delete this comment?</h1>
            <p>
                <strong>Name:</strong>{{$comment->name}}<br>
                <strong>Email:</strong>{{$comment->email}}<br>
                <strong>Comment:</strong>{{$comment->comment}}
                
            {{Form::open(['route'=>['comments.destroy',$comment->id],'method'=>'DELETE'])}}    
   {{Form::submit('Yes Delete This comment',['class'=>'btn btn-lg btn-block btn-danger'])}}   
   {{Form::close()}}
   
   
        </div>

</div>


@endsection