	@extends ('main')

	@section('title','| Edit Blog Post')

	@section('stylesheets')
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

	@section ('content')

		<div class="row">
		{!!Form::model($post,['route'=>['posts.update',$post->id],'method'=>"PUT",'files'=>'true']) !!}
		<div class="col-md-8">
			{{ Form::label('title','Title:')}}
			{{Form::text('title',null,["class"=>"form-control input-lg"])}}

			{{Form::label('slug','Slug:',array('class'=>'form-spacing-top'))}}
			{{Form::text('slug',null, ["class"=>"form-control"])}}

			{{Form::label('category_id','Category:', array('class'=>'form-spacing-top'))}}
			{{Form::select('category_id',$categories, null, array('class'=>'form-control '))}}

			{{Form::label('tags[]','Tags:',array('class'=>'form-spacing-top'))}}
			{{Form::select('tags[]',$tags, null,array('class'=>'select2-multi form-control','multiple'=>'multiple'))}}

			{{Form::label('featured_image','Update Featured Image',array('class'=>'form-spacing-top'))}}
				{{Form::file('featured_image')}}
			
			{{Form::label('body','Body:',["class"=>'form-spacing-top'])}}
			{{Form::textarea('body',null, ["class"=>"form-control"])}}
		</div>

		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{date('M j,Y h:ia',strtotime($post->created_at))}}</dd>	
				</dl>
				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{date('M j,Y h:ia',strtotime($post->updated_at))}}</dd>	
				</dl>	
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.show','Cancel',array($post->id), array('class'=>"btn btn-danger btn-block")) !!}
						
						
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes',['class'=>'btn btn-success btn-block']) }}
					
					</div>
				</div>

			</div>	
		</div>
		{!!Form::close()!!}
	</div> 


	@stop
	@section('scripts')
    <script type="text/javascript" src="/js/select2.min.js"></script>
    <script type="text/javascript">
    	$('.select2-multi').select2();
    	$('.select2-multi').select2().val({!! json_encode($post->tags->pluck('id')) !!} ). trigger('change');
    </script>
  	@endsection