@extends('main')

@section('title','| All Categories')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">
				<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
				</tr>
				</thead>
				<tbody>
				@foreach($categories as $category)
					<tr>
						<th>{{$category->id}}</th>
						<td>{{$category->name}}</td>
						
					</tr>
				@endforeach	
				</tbody>
			</table>
		</div> <!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
				{!!Form::open(['route'=>'categories.store'])!!}
					<h2>New Category</h2>
				{{ Form::label('name','Name:')}}
				{{ Form::text('name',null,array('class'=>'form-control'))}}
				{{Form::submit('Create new Category',array('class'=>'btn btn-primary btn-block btn-h2-spacing'))}}

				{!! Form::close() !!}
			</div>
		</div>
	</div>

@stop