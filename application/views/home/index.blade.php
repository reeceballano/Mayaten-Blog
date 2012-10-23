@layout('layouts.default')

@section('navigation')
	@parent
	<li><a href="/about">About</a></li>
@endsection

@section('content')
	<div class="hero-unit">
		<div class="row">
			<div class="span7">
				<h4>Latest Blog Posts</h4>
				<ul>
				@foreach($posts as $post)
					<li>
						{{ HTML::link_to_route('post_view', $post->title, array($post->id)) }} <small><em>by {{ $post->author }}</em></small></li>
				@endforeach
				</ul>
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