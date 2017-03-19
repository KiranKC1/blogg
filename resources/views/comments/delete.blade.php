@extends('main')

@section('title','|Delete Comment?')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Delete This Comment</h1>
		<p>
			<strong>Name:{{$comment->name}}</strong><br>
			<strong>Email:{{$comment->email}}</strong><br>
			<strong>Comment:{{$comment->comment}}</strong>
		</p>
		{{Form::open(array('route'=>array('comments.destroy',$comment->id),'method'=>'DELETE'))}}
			{{Form::submit('Yes Delete This Comment',array('class'=>'btn btn-lg btn-block btn-danger'))}}
		
		{{Form::close()}}
		
	</div>
</div>

@stop