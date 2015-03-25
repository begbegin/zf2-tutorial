<?php
namespace Blog\Controller;

use Zend\Mvc\Controller as controller;
use Blog\Interfaces\PostServiceInterface;
use Zend\View\Model\ViewModel;
use Blog\Entity\Post;

Class ListController extends controller\AbstractActionController{
	
	protected $postService;
	
	public function __construct(PostServiceInterface $postService){
		$this->postService = $postService;
	}
	
	
	public function indexAction(){
		return new ViewModel(array(
			'posts' => $this->postService->findAllPost(),
		));
	}
	
	
	public function detailAction(){
		$id = $this->params()->fromRoute('id');
	
		$post =  $this->postService->findPost($id);
		//print_r($post);
		if (null == $post) return $this->redirect()->toRoute('post');
		
		return new ViewModel(array( 'post' =>  $post));
	}
	
	
}