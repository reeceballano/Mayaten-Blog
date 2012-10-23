<?php

class Post Extends Eloquent {
	public static $table = 'posts';
	public static $rules = array(
									'title' => 'required|max:100',
									'body' => 'required',
									'author' => 'required|max:50',
									'category' => 'required'
								);

	public function comments() {
		return $this->has_many('Comment', 'post_id');
	}

	public function category() {
		return $this->belongs_to('Category');
	}

	public static function validate($inputs) {
		return Validator::make($inputs, static::$rules);
	}


}