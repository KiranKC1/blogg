@extends('main')

@section('title','| Create new Post')

@section('stylesheets')
    <link rel='stylesheet' href='/css/parsley.css' />
    <link rel='stylesheet' href='/css/select2.min.css' />
    <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=mqm248rfzxqrrtgeqs7z8zuqkha196x3ozbp9468cjs9f51f"></script>
    <script>
    	tinymce.init({
    		selector: 'textarea',
    		 plugins: 'link code',
    		 menubar: false

    	});
    </script>
@endsection


@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>
			{!! Form::open(array('route' => 'posts.store' , 'data-parsley-validate' =>'','files'=>true)) !!}
				{{Form::label('title','Title:')}}
				{{Form::text('title',null,array('class'=>'form-control','required'=>'', 'maxlength'=>'255'))}}

				{{ Form::label('slug','Slug')}}
				{{ Form::text('slug',null,array('class'=>'form-control','required'=>'','maxlength'=>'255','minlength'=>'5'))}}

				{{ Form::label('category_id','Category:')}}
				<select class="form-control" name="category_id">
				@foreach($categories  as $category)
				<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
				</select>

				{{ Form::label('tags','Tags:')}}
				<select class="form-control select2-multi" name="tags[]" multiple="multiple">
				@foreach($tags  as $tag)
				<option value="{{$tag->id}}">{{$tag->name}}</option>
				@endforeach
				</select>

				{{Form::label('featured_image','Upload Featured Image')}}
				{{Form::file('featured_image')}}

				
				{{Form::label('body','Body:')}}
				{{Form::textarea('body',null/*'Enter the description' yo garyo bhane chain placeholder jastai kam garcha*/,array('class'=>'form-control'))}}

				{{Form::submit('Create Post',array('class'=>'form-control', 'class'=>'btn btn-lg btn-block btn-success','style'=>'margin-top:20px;'))}}
			{!! Form::close() !!}

		</div>
	</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="/js/parsley.min.js"></script>
    <script type="text/javascript" src="/js/select2.min.js"></script>
    <script type="text/javascript">
    	$('.select2-multi').select2();
    </script>
@endsection