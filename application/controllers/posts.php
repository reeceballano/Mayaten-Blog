<?php

class Posts_Controller Extends Base_Controller {
	public $restful = true;

	public function get_index() {
		return View::make('posts.index')
			->with('title', 'Mayaten Blog')
			->with('posts', Post::with('category')->order_by('created_at', 'desc')->get())
			->with('recent_comments', Comment::order_by('created_at', 'desc')->get());

	}

	public function get_show($slug) {
		$post = Post::where_slug($slug)->first();
		return View::make('posts.view')
			->with('title', $post->title . '- Mayaten Blog')
			->with('post', $post)
			->with('comments', $post->comments)
			->with('recent_comments', Comment::order_by('created_at', 'desc')->get());
	}

	public function get_new() {
		return View::make('posts.new')
			->with('title', 'Add new Post')
			->with('categories', Category::lists('name', 'id'))
			->with('recent_comments', Comment::order_by('created_at', 'desc')->get());
	}

	public function post_create() {
		$validation = Post::validate(Input::all());

		if($validation->fails()) {
			return Redirect::to_route('post_add')
				->with_errors($validation)
				->with_input();
		} else {
			$thetitle = Input::get('title');
			$slug = Str::slug($thetitle);
			
			/*OLD
			$check = Post::where_slug($slug)
				->or_where('slug', 'LIKE', str_replace('_', '\_', $slug) . '-_')
				->get(); 	
			*/
				
			$check = Post::where('slug', 'REGEXP', '^'.$slug.'(-[[:digit:]]+)?$')->get();	
			
			if ( $check ) {
				$n = count($check);
				$slug .= '-' . ++$n;
			}
			
			Post::create(array(
				'title' => $thetitle,
				'body' => Input::get('body'),
				'author' => Input::get('author'), // Auth::user()->id ?
				'category_id' => Input::get('category'),
				'slug' => $slug,
			));

			return Redirect::to_route('post_add')
				->with('message', 'New post added successfully!');
		}
	}

	public function action_createSlug ($string) {
		
	}

	public function get_edit($id) {
		$post = Post::find($id);

		return View::make('posts.edit')
			->with('title', $post->title . 'Edit - Mayaten.com Blog')
			->with('post', Post::find($id))
			->with('categories', Category::lists('name', 'id'))
			->with('recent_comments', Comment::order_by('created_at', 'desc')->get());
	}

	public function put_update() {
		$validation = Post::validate(Input::all());
		$s = Input::get('title');
		$t = Str::slug($s);
		$post = Post::find(Input::get('id'));

		if($validation->fails()) {
			return Redirect::to_route('post_edit',  $t)
				->with_errors($validation)
				->with_input();
		} else {
			Post::update(Input::get('id'), array(
				'title' => Input::get('title'),
				'body' => Input::get('body'),
				'author' => Input::get('author'),
				'category_id' => Input::get('category'),
			));
			return Redirect::to_route('post_view', $post->slug)
				->with('message', 'Post has been updated successfully!');
		}	
	}

	public function delete_destroy() {
		$id = Input::get('id');
		
		//*Note: Make sure to set post_id as your foreign key.
		//*Note: Set ON DELETE CASCADE in your comments table
		Post::find($id)->delete();
		
		//*Info: Incase you didn't set your comments table "ON DELETE CASCADE", just the code below.
		//Post::find($id)->comments()->delete();
		//Post::find($id)->delete();

		return Redirect::to_route('posts')
			->with('message', 'Post has been deleted successfully!');

	}
}