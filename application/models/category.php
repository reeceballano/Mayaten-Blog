<?php

class Category Extends Eloquent {
	public static $table = 'categories';

	public function posts() {
		return $this->has_many('Post');
	}
}