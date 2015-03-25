<?php
namespace Blog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Blog\Controller\WriteController;
use Blog\Form\PostForm;
class WriteControllerFactory implements FactoryInterface{
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		
		$realServiceLocator = $serviceLocator->getServiceLocator();
		$postService = $realServiceLocator->get('Blog\Interfaces\PostServiceInterface');
		
		$postForm = $realServiceLocator->get('FormElementManager')->get('Blog\Form\Post');
		
		return new WriteController($postService, $postForm);
		
	}
}