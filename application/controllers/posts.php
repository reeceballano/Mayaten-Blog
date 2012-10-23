<?php

class Posts_Controller Extends Base_Controller {
	public $restful = true;

	public function get_index() {
		return View::make('posts.index')
			->with('title', 'Mayaten Blog')
			->with('posts', Post::with('category')->get())
			->with('recent_comments', Comment::order_by('created_at')->get());

	}

	public function get_show($id) {
		return View::make('posts.view')
			->with('title', Post::find($id)->title . '- Mayaten Blog')
			->with('post', Post::find($id))
			->with('comments', Post::find($id)->comments()->get())
			->with('recent_comments', Comment::order_by('created_at')->get());
	}

	public function get_new() {
		return View::make('posts.new')
			->with('title', 'Add new Post')
			->with('categories', Category::lists('name', 'id'))
			->with('recent_comments', Comment::order_by('created_at')->get());
	}

	public function post_create() {
		$validation = Post::validate(Input::all());

		if($validation->fails()) {
			return Redirect::to_route('post_add')
				->with_errors($validation)
				->with_input();
		} else {
			Post::create(array(
				'title' => Input::get('title'),
				'body' => Input::get('body'),
				'author' => Input::get('author'),
				'name' => Input::get('category'),
			));

			return Redirect::to_route('post_add')
				->with('message', 'New post has been added successfully!');
		}
	}

	public function get_edit($id) {
		return View::make('posts.edit')
			->with('title', Post::find($id)->title . 'Edit - Mayaten.com Blog')
			->with('post', Post::find($id))
			->with('categories', Category::lists('name', 'id'))
			->with('recent_comments', Comment::order_by('created_at')->get());
	}

	public function put_update() {
		$validation = Post::validate(Input::all());

		if($validation->fails()) {
			return Redirect::to_route('post_edit',  Input::get('id'))
				->with_errors($validation)
				->with_input();
		} else {
			Post::update(Input::get('id'), array(
				'title' => Input::get('title'),
				'body' => Input::get('body'),
				'author' => Input::get('author'),
				'category_id' => Input::get('category'),
			));

			return Redirect::to_route('post_view', Input::get('id'))
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