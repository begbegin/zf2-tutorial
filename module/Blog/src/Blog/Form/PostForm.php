<?php
namespace Blog\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Blog\Entity\Post;
class PostForm extends Form implements ObjectManagerAwareInterface {
	
	protected $objectManager;
	//protected $inputFilter;
	
	public function __construct(ObjectManager $objectManager){
		
		parent::__construct('post-fieldset');
		$this->objectManager = $objectManager;
		//$this->inputFilter = new PostInputFilter($objectManager);
		
		$hydrator = new DoctrineHydrator($objectManager);
		$postFieldSet = new PostFieldset('post-fieldset' , $this->objectManager);
		
		$postFieldSet->setUseAsBaseFieldset(true);
		$postFieldSet->setHydrator($hydrator)->setObject(new Post());
	
		$this->add($postFieldSet);
		
		//$this->setInputFilter(new PostInputFilter($objectManager));
		//set hydrator
		$this->setHydrator($hydrator)->setObject(new Post());
		
		$this->add(array(
				'type' => 'submit',
				'name' => 'submit',
				'attributes' => array(
						'value' => utf8_encode('Insérer le post'),
				)
		));
		
		
			
		
	}
	
	// @codeCoverageIgnore
	public function setObjectManager(ObjectManager $objectManager)
	{
		$this->objectManager = $objectManager; 
	}
	
	// @codeCoverageIgnore
	public function getObjectManager()
	{
		return $this->objectManager; 
	}
	

	
}