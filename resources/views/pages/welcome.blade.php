@extends('main')

@section('title','| Homepage')
@section('content')

      <div class="row">
        <div class="col-md-12">
          <div class="jumbotron" style="background: url('image/picture.jpg') no-repeat 0px; min-height: 300px;" >
            <h1 align="center">To Travel is To Live!</h1>
           
          </div>
        </div>
      </div>
      <!-- end of header .row -->

      <div class="row">
        <div class="col-md-6" >
        <H2>Recent Posts</H2>

          @foreach($posts as $post)
            <div class="post">
            <h3> <a href="{{url('blog',$post->slug)}}">{{$post->title}}</a></h3>
            @if($post->image!=null)
           <img src="{{asset('images/'. $post->image)}}" height="200" width="400">
           @endif
            <p>{{ substr(strip_tags($post->body),0,300)}} {{strlen(strip_tags($post->body))> 300 ? "..." :""}}</p>
            <a href="{{url('blog',$post->slug)}}" class="btn btn-primary">Read More</a>

          </div>

          <hr>

          @endforeach

        </div>

        
      </div>

    @endsection