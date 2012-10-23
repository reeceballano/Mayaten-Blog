<?php

class Comments_Controller Extends Base_Controller {
	public $restful = true;

	public function get_index() {
		
	}

	public function post_add() {
		$id = Input::get('id');

		$validation = Comment::validate(Input::all());

		if($validation->fails()) {
			return Redirect::to_route('post_view', $id)
				->with_errors($validation)
				->with_input();
		} else {
			Comment::create(array(
				'user'=>Input::get('user'),
				'post_id'=> Input::get('id'),
				'comment_msg' => Input::get('comment_msg')
			));
			return Redirect::to_route('post_view', $id)
				->with('message', 'Comment Posted successfully!');
		}
	}

	public function delete_destroy() {
		$cid = Input::get('cid');
		$pid = Input::get('pid');
		
		Comment::find($cid)->delete();

		return Redirect::to_route('post_view', $pid)
			->with('message', 'Comment has been deleted Successfully!');
	}
}