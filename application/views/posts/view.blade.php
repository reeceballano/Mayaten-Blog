@layout('layouts.default')

@section('navigation')
	@parent
	<li><a href="/about">About</a></li>
@endsection

@section('content')
	<div class="hero-unit">
		<div class="row">
			<div class="span7">
				<h4>{{ $post->title }}</h4>
				<span><small>Posted by: {{ $post->author }}</small></span>
				
				<hr>
				
				<p>{{ $post->body }}</p>

				<p>{{ HTML::link_to_route('post_edit', 'Edit', array($post->id), array('class'=>'btn primary')) }}
					{{ Form::open('post/delete', 'DELETE') }}
						{{ Form::hidden('id', $post->id)}}
						{{ Form::submit('Delete', array('style'=>'display:inline-block !important;', 'class'=>'btn red-color')) }}
					{{ Form::close() }}
				</p>
				
				<hr>

				<h5>Comments:</h5>
				<ul>
				@foreach($comments as $comment)
					<li>{{ $comment->user }}: {{ $comment->comment_msg }}
					  	{{ Form::open('comment/delete', 'DELETE') }}
					  		{{ Form::hidden('cid', $comment->id) }}
					  		{{ Form::hidden('pid', $post->id) }}
					  		{{ Form::submit('Delete', array('class'=>'btn primary')) }}
					  	{{ Form::close() }}
					</li>
				@endforeach
				</ul>

				<hr>

				<h5>Share Your Thoughts!</h5>

				@if(Session::has('message'))
					{{ Session::get('message') }}
				@endif

				@if($errors->has())
					{{ $errors->first('user', '<li>:message</li>') }}
					{{ $errors->first('comment_msg', '<li>:message</li>') }}
				@endif

				{{ Form::open('comment/add', 'POST') }}
					{{ Form::label('user', 'Name:') }}
					{{ Form::text('user', Input::old('user')) }} <br />

					{{ Form::label('comment_msg', 'Message:') }} <br />
					{{ Form::textarea('comment_msg', Input::old('comment_msg')) }} <br />

					{{ Form::hidden('id', $post->id) }}

					{{ Form::submit('Add Comment', array('class', 'btn primary')) }}
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