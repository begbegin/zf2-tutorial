<?php
namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Services\PostService;
use Blog\Form\PostForm;
use Zend\View\Model\ViewModel;
use Blog\Interfaces\PostServiceInterface;
use Blog\Form\PostInputFilter;
/**
 * @author w.begbessou
 *
 */
class WriteController extends AbstractActionController{
	
	protected $postService;
	protected $postForm;
	
	public function __construct(PostService $postService, PostForm $postForm){
		$this->postService = $postService;
		$this->postForm = $postForm;
	}
	
	public function addAction(){
		
		$request = $this->getRequest();
		if ($request->isPost()){
			$posts = $request->getPost();
			$this->postForm->setData($request->getPost());
			//$this->postForm->setInputFilter(new PostInputFilter($this->getServiceLocator()->get('Doctrine\ORM\EntityManager')));
			if ($this->postForm->isValid()){
				try {
					$post = $this->postForm->getData();			
					$this->postService->savePost($post);
					return $this->redirect()->toRoute('post');
				} catch (Exception $e) {
					throw new \Exception();
				}
			}
		}
		
		return new ViewModel(array(
						'form' => $this->postForm,
				
						));
				
	}
	
	
	public function editAction(){
		$request = $this->getRequest();
		
		$post = $this->postService->findPost($this->params('id'));
		if (null == $post) return $this->redirect()->toRoute('post');
		
		$this->postForm->bind($post);
		if ($request->isPost()){
			$this->postForm->setData($request->getPost());
				
			if ($this->postForm->isValid()){
				try {
					
					$this->postService->savePost($post);
					return $this->redirect()->toRoute('post');
				} catch (Exception $e) {
						
				}
			}
		}
		
		return new ViewModel(array(
				'form' => $this->postForm,
		
		));
	}
	
	
	public function deleteAction(){
	
		$post = $this->postService->findPost($this->params('id'));
		if (null == $post) return $this->redirect()->toRoute('post');
		
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			//$post = $request->getPost();
			$del = $request->getPost('delete_confirmation', 'no');
		
			if ($del === 'yes') {
				$this->postService->deletePost($post);
			}
		
			return $this->redirect()->toRoute('post');
		}
		
		return new ViewModel(array(
				'post' => $post
		));
	}
	

}