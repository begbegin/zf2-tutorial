<?php
namespace Blog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Blog\Form\PostForm;

class PostFormFactory implements FactoryInterface{
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		
		$realServiceLocator = $serviceLocator->getServiceLocator();
		
		return new PostForm($realServiceLocator->get('Doctrine\ORM\EntityManager'));
		
	}
}