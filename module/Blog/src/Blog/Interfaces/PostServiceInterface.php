<?php
namespace Blog\Interfaces;

interface PostServiceInterface{
	
	public function findAllPost();
	public function findPost($id);
}