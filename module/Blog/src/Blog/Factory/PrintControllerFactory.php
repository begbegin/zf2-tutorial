<?php
namespace Blog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Blog\Controller\PrintController;
class PrintControllerFactory implements FactoryInterface{
	/* (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) {
		// TODO: Auto-generated method stub
		$realServiceLocator = $serviceLocator->getServiceLocator();
		$postService = $realServiceLocator->get('Blog\Interfaces\PostServiceInterface');
		$enfantService = $realServiceLocator->get('Blog\Services\EnfantService');
		
		return new PrintController($postService, $enfantService);
		
	}
}