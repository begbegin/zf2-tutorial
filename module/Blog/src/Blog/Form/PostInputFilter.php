<?php
namespace Blog\Form;

use Zend\InputFilter\InputFilter;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\InputFilter\InputFilterProviderInterface;
class PostInputFilter extends InputFilter implements InputFilterProviderInterface{
	
	public function __construct(ObjectManager $objManager){
		
		
		$this->add(array(
					'name'     => 'title',
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
			));
		
		$this->add(array(
				'name'     => 'text',
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
		));
	}
	
	/**
	 * @return array
	 */
	public function getInputFilterSpecification()
	{
		return array(
				'name' => array(
						'required' => true,
				),
		);
	}
}