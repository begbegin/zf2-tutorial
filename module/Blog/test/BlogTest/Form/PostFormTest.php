<?php
namespace BlogTest\Form;

use Blog\Form\PostForm;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
class  PostFormTest extends AbstractHttpControllerTestCase{
	

	protected $traceError = true;
	protected $serviceLocator;
	
	public function setUp(){
		$this->setApplicationConfig(
				include __DIR__.'/../../../../../config/application.config.php'
		);
	
		$this->serviceLocator = $this->getApplicationServiceLocator();
	
		parent::setUp();
	
	}
	
	public function testFormElementsAreSetCorrectly(){
		$postForm = $this->serviceLocator->get('FormElementManager')->get('Blog\Form\Post');
		//$postForm = new PostForm($objectManager);
		$elements = $postForm->getElements();
		$postFieldElements = $postForm->get('post-fieldset');
		
		$this->assertSame(2, $postForm->count());
		$this->assertSame(3, $postForm->get('post-fieldset')->count());
		
		$this->assertTrue($postFieldElements->has('id'));
		$this->assertTrue($postFieldElements->has('title'));
		$this->assertTrue($postFieldElements->has('text'));
		$this->assertTrue($postForm->has('submit'));
		
		$this->assertInstanceOf('Zend\Form\Element\Hidden', $postFieldElements->get('id'));
		$this->assertInstanceOf('Zend\Form\Element\Text', $postFieldElements->get('title'));
		$this->assertInstanceOf('Zend\Form\Element\Text', $postFieldElements->get('text'));
		$this->assertInstanceOf('Zend\Form\Element\Submit', $postForm->get('submit'));
		
	}
	
	public function testInputFilterIsSetCorrectly(){
		$postForm = $this->serviceLocator->get('FormElementManager')->get('Blog\Form\Post');
		//$postForm = new PostForm($objectManager);
		$postInputFilter = $postForm->getInputFilter()->get('post-fieldset');
		
		$this->assertSame(3, $postInputFilter->count());
		$this->assertTrue($postInputFilter->has('title'));
		$this->assertTrue($postInputFilter->has('text'));
		
	}
	
	public function testFormValidation(){
		$postForm = $this->serviceLocator->get('FormElementManager')->get('Blog\Form\Post');
		$datas = array(
				'post-fieldset' => array(
						'id' => '',
						'title' => 'Les',
						'text' => 'Contenue des',
				)
	
		);
	
		$postForm->setData($datas);
		$this->assertTrue($postForm->isValid(), 'Le formulaire doit etre valide');
		
		$datas['post-fieldset']['title'] ='';
		
		$postForm->setData($datas);
		$this->assertNotTrue($postForm->isValid(), 'Le formulaire ne doit pas etre valide');
		
	}
}
