<?php
namespace Album\Form;
use Zend\Form\Form;

Class AlbumForm extends Form{
	
	public function __construct($name = null){
		parent::__construct('album');
		
		$this->add(
				array(
						'name' => 'id',
						'type' => 'Hidden',
						));
		
		$this->add(array(
				'name' => 'title',
				'type' => 'Text',
				'options' => array(
						'label' => 'Titre',
						)
				));
		
		$this->add(array(
				'name' => 'artist',
				'type' => 'Text',
				'options' => array(
						'label' => 'Artist',
						)
				));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'submitbutton',
						),
				));
	}
}