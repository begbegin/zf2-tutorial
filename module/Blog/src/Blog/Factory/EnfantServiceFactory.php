<?php
namespace Blog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Blog\Services\EnfantService;
use Zend\ServiceManager\ServiceLocatorInterface;
class EnfantServiceFactory implements FactoryInterface{
	
	/* (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) {
		return new EnfantService($serviceLocator->get('Doctrine\ORM\EntityManager')->getRepository('Blog\Entity\Enfant'));
	}

}