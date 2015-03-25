<?php
namespace BlogTest\Controller;


use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Blog\Entity\Post;
use Doctrine\ORM\ORMInvalidArgumentException;
class WriteControllerTest extends AbstractHttpControllerTestCase{
	
	protected $traceError = true;
	protected $serviceLocator;
	protected $controller;
	public function setUp(){
		$this->setApplicationConfig(
				include 'D:/xampp/htdocs/zf2-project/config/application.config.php'
				);
		$this->serviceLocator = $this->getApplicationServiceLocator();
		$this->controller = $this->serviceLocator->get('ControllerLoader')->get('Blog\Controller\Write');
		parent::setUp();
	}
	
	public function testAddActionFormIsDisplayed(){
		$this->dispatch('/blog/add');
		
		$this->assertResponseStatusCode('200');
		$this->assertActionName('add');
		$this->assertQuery('form');
		$this->assertNotRedirect();
	}
	
	
	public function testAddActionSaveDataFailed(){
	
		$postServiceMock = $this->getMockBuilder('Blog\Services\PostService')
		->disableOriginalConstructor()
		->getMock();
	
		$postServiceMock->expects($this->once())
		->method('savePost')
		->will($this->throwException(new \Exception));
		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('Blog\Interfaces\PostServiceInterface', $postServiceMock);
	
		$datas = array(
				'post-fieldset' => array(
						'id' => '',
						'title' => 'Les elections',
						'text' => 'Contenue des',
				)
	
	
		);
		try {
			$this->dispatch('/blog/add', 'POST', $datas);
			//$this->setExpectedException('Exception');
			//$this->assertResponseStatusCode(500);
			//$this->assertRedirectTo('/blog');
			//$this->setExpectedException('ReflectionException');
		} catch (Exception $e) {
			$this->fail($e->getMessage());
		}
		
		$this->setExpectedException('Exception');
		
		
	}
	
	public function testAddActionFormDataWasSaved(){
		
		$postServiceMock = $this->getMockBuilder('Blog\Services\PostService')
								->disableOriginalConstructor()
								->getMock();
		
		$postServiceMock->expects($this->once())
						->method('savePost')
						->will($this->returnValue(null));
		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('Blog\Interfaces\PostServiceInterface', $postServiceMock);
		
		$datas = array(
				'post-fieldset' => array(
						'id' => '',
						'title' => 'Les elections',
						'text' => 'Contenue des',
				)
				
				
		);
		
		$this->dispatch('/blog/add', 'POST', $datas);
		$this->assertActionName('add');
		$this->assertResponseStatusCode(302);
		$this->assertRedirectTo('/blog');
	}
	
	
	
	public function testEditActionRedirectWithInavaliPostId(){
		$this->dispatch('/blog/edit/9999999999999999999');
		
		$this->assertResponseStatusCode(302);
		$this->assertRedirectTo('/blog');
	}
	
	
	public function testEditActionFormIsDisplayedWithData(){
		$postServiceMock = $this->getMockBuilder('Blog\Services\PostService')
		->disableOriginalConstructor()
		->getMock();
		
		$postServiceMock->expects($this->once())
		->method('findPost')
		->will($this->returnValue(new Post()));
		
		
		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('Blog\Interfaces\PostServiceInterface', $postServiceMock);
		$this->dispatch('/blog/edit/1099999999999999999999999');
	
		$this->assertResponseStatusCode('200');
		$this->assertActionName('edit');
		$this->assertQuery('form');
		$this->assertNotRedirect();
	}
	
	public function testEditActionFormDataWasUpdate(){
	
		$postServiceMock = $this->getMockBuilder('Blog\Services\PostService')
								->disableOriginalConstructor()
								->getMock();
	
		$postServiceMock->expects($this->once())
						->method('findPost')
						->will($this->returnValue(new Post()));
		$postServiceMock->expects($this->once())
						->method('savePost')
						->will($this->returnValue(null));
		
		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('Blog\Interfaces\PostServiceInterface', $postServiceMock);
	
		$datas = array(
				'post-fieldset' => array(
						'id' => '',
						'title' => 'Les elections',
						'text' => 'Contenue des',
				)
	
	
		);
	
		$this->dispatch('/blog/edit/10', 'POST', $datas);
		$this->assertActionName('edit');
		$this->assertResponseStatusCode(302);
		$this->assertRedirectTo('/blog');
	}
	
	
	// deleteAction
	
	public function testDeleteActionRedirectWithInavaliPostId(){
		$this->dispatch('/blog/delete/9999999999999999999');
		
		$this->assertResponseStatusCode(302);
		$this->assertRedirectTo('/blog');
	}
	
	
	public function testDeleteActionConfirmationFormIsDisplayed(){
		$postServiceMock = $this->getMockBuilder('Blog\Services\PostService')
								->disableOriginalConstructor()
								->getMock();
	
		$postServiceMock->expects($this->once())
						->method('findPost')
						->will($this->returnValue(new Post()));
	
	
		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('Blog\Interfaces\PostServiceInterface', $postServiceMock);
		$this->dispatch('/blog/delete/1099999999999999999999999');
	
		$this->assertResponseStatusCode('200');
		$this->assertActionName('delete');
		$this->assertQuery('form');
		$this->assertNotRedirect();
	}
	
	
	public function testDeleteActionPostDeleted(){
	
		$postServiceMock = $this->getMockBuilder('Blog\Services\PostService')
								->disableOriginalConstructor()
								->getMock();
	
		$postServiceMock->expects($this->once())
						->method('findPost')
						->will($this->returnValue(new Post()));
		$postServiceMock->expects($this->once())
						->method('deletePost')
						->will($this->returnValue(null));
	
		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('Blog\Interfaces\PostServiceInterface', $postServiceMock);
	
		$datas = array('delete_confirmation' => 'yes');
				
	
		
	
		$this->dispatch('/blog/delete/8888888888888', 'POST', $datas);
		$this->assertActionName('delete');
		$this->assertResponseStatusCode(302);
		$this->assertRedirectTo('/blog');
		
	}
	
	public function testDeleteActionPostDeletingCanceled(){
	
		$postServiceMock = $this->getMockBuilder('Blog\Services\PostService')
		->disableOriginalConstructor()
		->getMock();
	
		$postServiceMock->expects($this->once())
		->method('findPost')
		->will($this->returnValue(new Post()));
		$postServiceMock->expects($this->never())
		->method('deletePost')
		->will($this->returnValue(null));
	
		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('Blog\Interfaces\PostServiceInterface', $postServiceMock);
	
		$datas = array('delete_confirmation' => 'no');
	
		$this->dispatch('/blog/delete/8888888888888', 'POST', $datas);
		$this->assertActionName('delete');
		$this->assertResponseStatusCode(302);
		$this->assertRedirectTo('/blog');
	
	}
}