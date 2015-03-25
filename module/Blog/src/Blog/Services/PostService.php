<?php
namespace Blog\Services;

use Blog\Interfaces\PostServiceInterface;
use Blog\Repository\PostRepository;
use Blog\Entity\Post;

class PostService  implements PostServiceInterface{
	
	protected $postRepository;
	
	public function __construct(PostRepository $postRepo){
		$this->postRepository = $postRepo;
	}
	
	public function findAllPost(){
		return $this->postRepository->findAll();
	}
	
	public function findPost($id){
		return $this->postRepository->find($id);
	}
	
	public function savePost(Post $post){
		try {
			 $this->postRepository->save($post);
		} catch (Exception $e) {
			throw new \Exception(); // @codeCoverageIgnore
		}
		
	}
	
	public function deletePost(Post $post){
		try {
			$this->postRepository->delete($post);
		} catch (Exception $e) {
			throw new \Exception(); // @codeCoverageIgnore
		}
	
	}
}