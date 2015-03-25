<?php
namespace Blog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Blog\Services\PostService;
class PostServiceFactory implements FactoryInterface{
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		
		$entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
		$postRepo = $entityManager->getRepository('Blog\Entity\Post');
		return new PostService($postRepo);
		
	}
}