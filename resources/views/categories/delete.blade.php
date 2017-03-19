@extends('main')

@section('title','|Delete Category?')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Delete This Category</h1>
		<p>
			<strong>Name:{{$category->name}}</strong><br>
			
		</p>
		{{Form::open(array('route'=>array('categories.destroy',$category->id),'method'=>'DELETE'))}}
			{{Form::submit('Yes Delete This Category',array('class'=>'btn btn-lg btn-block btn-danger'))}}
		
		{{Form::close()}}
		
	</div>
</div>

@stop