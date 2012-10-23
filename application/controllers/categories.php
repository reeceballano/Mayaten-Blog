<?php

class Categories_Controller Extends Base_Controller {
	public $restful = true;

	public function get_show($id) {
		return View::make('categories.index')
			->with('title', Category::find($id)->name)
			->with('posts', Category::find($id)->posts()->get())
			->with('recent_comments', Comment::order_by('created_at')->get());
	}
}