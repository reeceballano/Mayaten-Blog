<?php

class Comment Extends Eloquent {
	public static $table = 'comments';
	public static $rules = array(
		'user'=>'required',
		'comment_msg'=>'required|max:200'
		);

	public static function validate($inputs) {
		return Validator::make($inputs, static::$rules);
	}

	public function post() {
		return $this->belongs_to('Post');
	}
}