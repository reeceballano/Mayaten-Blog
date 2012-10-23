<?php

class Users_Controller Extends Base_Controller {
	public $restful = true;

	public function get_index() {

	}

	public function get_show($id) {

	}

	public function get_add() {

	}

	public function post_create() {
		User::create(
			array(
					'username' => 'reece',
					'password' => Hash::make('reecepassword'),
					'email' => 'reece@localhost.com',
					'created_at' => date('Y-m-d H:m:i'),
					'updated_at' => date('Y-m-d H:m:i')
				 )
		);

		echo "Success!";
	
	}

	public function get_edit() {

	}

	public function put_update() {

	}

	public function delete_destroy() {
		
	}
}