<?php

class User Extends Eloquent {
	public static $table = 'users';

	public function posts() {
		return $this->has_many('Post');
	}
}