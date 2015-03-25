<?php
namespace BlogTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
class ListControllerTest extends AbstractHttpControllerTestCase{
	protected $traceError = true;
	
	public function setup(){
		$this->setApplicationConfig(
				include 'D:/xampp/htdocs/zf2-project/config/application.config.php'
				);
		
		parent::setUp();
	}
	
	public function testIndexActionIsAccessible(){
		$this->dispatch('/blog');
		
		//assertions
		$this->assertResponseStatusCode(200);
		$this->assertModulesLoaded(array('Album', 'Blog'));
		$this->assertModuleName('Blog');
		$this->assertControllerName('Blog\Controller\List');
		$this->assertControllerClass('ListController');
		$this->assertMatchedRouteName('post');
	}
	
	
	public function testDetailActionRedirectAfterPostNotFound(){
		$this->dispatch('/blog/999999999999');
		
		$this->assertResponseStatusCode(302);
		$this->assertActionName('detail');
		$this->assertRedirectTo('/blog');
	}
	
	public function testDetailActionIsAccessible(){
		$this->dispatch('/blog/8');
	
		$this->assertResponseStatusCode(200);
		$this->assertQuery('dl');
		$this->assertMatchedRouteName('post/detail');
	}
}