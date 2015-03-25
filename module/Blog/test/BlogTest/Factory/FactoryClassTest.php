<?php
namespace BlogTest\Factory;

use PHPUnit_Framework_TestCase;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
class FactoryClassTest extends AbstractHttpControllerTestCase{
	
	protected $traceError = true;
	protected $serviceLocator;
	
	public function setUp(){
		$this->setApplicationConfig(
				include __DIR__.'/../../../../../config/application.config.php'
		);
		
		$this->serviceLocator = $this->getApplicationServiceLocator();
	
		parent::setUp();
		
	}
	
	
	public function testPostServiceIsCreated(){
		$this->assertTrue($this->serviceLocator->has('Blog\Interfaces\PostServiceInterface'));
		$this->assertInstanceOf('Blog\Services\PostService', $this->serviceLocator->get('Blog\Interfaces\PostServiceInterface'));
		
	}
	
	public function testPostFormIsCreated(){
		
		$this->assertTrue($this->serviceLocator->has('FormElementManager'));
		$this->assertTrue($this->serviceLocator->get('FormElementManager')->has('Blog\Form\Post'));
		$this->assertInstanceOf('Blog\Form\PostForm', $this->serviceLocator->get('FormElementManager')->get('Blog\Form\Post'));
	
	}
	
	public function testWriteControllerIsCreated(){
		$this->assertTrue($this->serviceLocator->get('ControllerLoader')->has('Blog\Controller\Write'));
		$this->assertInstanceOf('Blog\Controller\WriteController', $this->serviceLocator->get('ControllerLoader')->get('Blog\Controller\Write'));
	}
}