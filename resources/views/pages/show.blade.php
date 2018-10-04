@extends('main')
@section('title','| about')
@section('content')
<div class="row">
        <div class="col-md-12">
        <h2>{{$tag->name }}<small> {{$tag->posts()->count()}}</small></h2>
       </div> 
        @foreach($tag->posts as $post)
    <h3><a href="{{route('blog.single',$post->slug)}}">{{$post->title}}</a></h3> 
       @endforeach
    
   </div>
</div>
@endsection