@layout('layouts.default')

@section('navigation')
	@parent
	<li><a href="/about">About</a></li>
@endsection

@section('content')
	<div class="hero-unit">
		<div class="row">
			<div class="span7">
				@if(Session::has('message'))
					{{ Session::get('message') }}
				@endif

				@if($errors->has())
					{{ $errors->first('title', '<li>:message</li>') }}
					{{ $errors->first('body', '<li>:message</li>') }}
					{{ $errors->first('author', '<li>:message</li>') }}
					{{ $errors->first('category', '<li>:message</li>') }}
				@endif

				<h3 class="posttitle">Add new post</h3>

				{{ Form::open('post/create', 'POST') }}
					{{ Form::label('title', 'Title:') }} <br />
					{{ Form::text('title', Input::old('title')) }} <br />

					{{ Form::label('body', 'Body:') }} <br />
					{{ Form::textarea('body', Input::old('body')) }} <br />

					{{ Form::label('author', 'Author:') }} <br />
					{{ Form::text('author', Input::old('author')) }} <br />

					{{ Form::select('category', $categories, Input::old('category')) }} <br />

					{{ Form::submit('Add Post') }}
					
				{{ Form::close() }}
			</div>

			<div class="span3">
				<h4>Recent Comments</h4>
				<ul>
				@foreach($recent_comments as $comment)
					<li>{{ HTML::link_to_route('post_view', $comment->comment_msg, array($comment->post->slug)) }}</li>
				@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection