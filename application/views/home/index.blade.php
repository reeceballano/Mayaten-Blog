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
						{{ HTML::link_to_route('post_view', $post->title, array($post->slug)) }}  
						<small><em>by {{ $post->author }}</em></em></small> 
						<br />
						<small>Under: {{ HTML::link_to_route('category_show', $post->category->name, array($post->category->id)) }}</small>
				@endforeach
				</ul>

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