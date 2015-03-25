<?php
namespace Blog\Form;

use Zend\Form\Fieldset;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\InputFilter\InputFilterProviderInterface;
class PostFieldset extends Fieldset implements ObjectManagerAwareInterface, InputFilterProviderInterface{
	
	protected $objectManager;
	
	public function __construct($name, ObjectManager $objectManager){
		
		parent::__construct($name);
		
		$this->objectManager = $objectManager;
		
		$this->add(array(
				'type' => 'hidden',
				'name' => 'id',
		));
		
		$this->add(array(
				'type' => 'text',
				'name' => 'title',
				'options' => array(
						'label' => 'Titre du blog',
				)
		));
		
		$this->add(array(
				'type' => 'text',
				'name' => 'text',
				'options' => array(
						'label' => 'Le text du blog',
				)
		));
		
		/*$this->add(array(
				'type' => 'DoctrineModule\Form\Element\ObjectSelect',
				'name' => 'text-text',
				'options' => array(
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Blog\Entity\Post',
						'property'       => 'title',
				)
		));*/
				
			
	}
	
	
	/**
	 * @return array
	 */
	public function getInputFilterSpecification()
	{
		return array(

				'title' => array(
						'required' => true,
						'filters'  => array(
								array('name' => 'StripTags'),
								array('name' => 'StringTrim'),
						),
						'validators' => array(
								array(
										'name'    => 'StringLength',
										'options' => array(
												'encoding' => 'UTF-8',
												'min'      => 1,
												'max'      => 100,
										),
								),
						),
				),
				
				
				'text' => array(
						'required' => true,
						'filters'  => array(
								array('name' => 'StripTags'),
								array('name' => 'StringTrim'),
						),
						'validators' => array(
								array(
										'name'    => 'StringLength',
										'options' => array(
												'encoding' => 'UTF-8',
												'min'      => 1,
												'max'      => 100,
										),
								),
						),
				),
		);
	}
	
	public function setObjectManager(ObjectManager $objectManager)
	{
		$this->objectManager = $objectManager;
	}
	
	public function getObjectManager()
	{
		return $this->objectManager;
	}
}