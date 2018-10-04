@extends('main')
@section('title','| welcome')
@section('content')
 
        <div class="col-md-12">
            <div class="row">
            <div class="jumbotron">
            <h1>Welcome to my blog</h1>
            <p class="lead">Thank you for visiting </p>
            <p><a class="btn btn-primary" href="#" role="button">Popular Post</a> </p>
            </div>
          </div>
          <div class="row">
              <div class="col-md-8 ">
                  @foreach ($posts as $post)
                      
          
                  <div class="post">
                      <h3>{{$post->title}}</h3>
                      <p>{{str_limit(strip_tags($post->body,50))}}</p>
                  <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary">Read More</a>
                </div>
                    <hr>
                    @endforeach
                    <div class="text-center">
                    {!!$posts->links();!!}
                    </div>
              </div>
             <div class="col-md-3 col-md-offset-1">
           
<div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                 <h3 class="well">Sidebar</h3>

                    <div class="well" style="background:#c7c9c7;">
                        <ul class="nav">
                                @foreach ($tags as $tag)
                            <li class="active">
                            <a href="{{url('pages',$tag->id)}}">
                                {{$tag->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                  
                    </div>
                
                    
                </div>
            </div>
            
        </div>
    </div>
  
    <br>
            </div>

          </div>
        </div>
    
   
@endsection





    