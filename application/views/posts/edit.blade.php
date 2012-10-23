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

				<h3 class="posttitle"></h3>

				{{ Form::open('post/update', 'PUT') }}
					{{ Form::label('title', 'Title:') }} <br />
					{{ Form::text('title', $post->title) }} <br />

					{{ Form::label('body', 'Body:') }} <br />
					{{ Form::textarea('body', $post->body) }} <br />

					{{ Form::label('author', 'Author:') }} <br />
					{{ Form::text('author', $post->author) }} <br />

					{{ Form::hidden('id', $post->id) }}

					{{ Form::select('category', $categories, Input::old('category')) }} <br />

					{{ Form::submit('Update') }}
				{{ Form::close() }}
			</div>

			<div class="span3">
				<h4>Recent Comments</h4>
				<ul>
				@foreach($recent_comments as $comment)
					<li>{{ HTML::link_to_route('post_view', $comment->comment_msg, array($comment->post_id)) }}</li>
				@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection