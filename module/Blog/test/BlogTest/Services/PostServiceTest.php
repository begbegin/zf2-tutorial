<?php
namespace BlogTest\Services;
use PHPUnit_Framework_TestCase;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Blog\Entity\Post;
class PostServiceTest extends AbstractHttpControllerTestCase{
	
	protected $traceError = true;
	protected $serviceLocator;
	protected $lastInsertId;
	
	public function setUp(){
		$this->setApplicationConfig(
				include __DIR__.'/../../../../../config/application.config.php'
		);
	
		$this->serviceLocator = $this->getApplicationServiceLocator();
		
		parent::setUp();
	
	}
	
	public function testSavePost(){
		$postService = $this->serviceLocator->get('Blog\Interfaces\PostServiceInterface');
		$post = new Post();
		$post->setText('Unit Test post');
		$post->setTitle('Title post');
		try {
			$postService->savePost($post);
		} catch (Exception $e) {
			$this->fail($e->getMessage());
		}
		
		$this->lastInsertId = $post->getId();
		
		
		$this->assertNotNull($this->lastInsertId);
		$this->assertNotEmpty($this->lastInsertId);
		$this->assertInternalType('int', $this->lastInsertId);
		
		return $this->lastInsertId;
	}
	
	public function testFindAllPost(){
		$postService = $this->serviceLocator->get('Blog\Interfaces\PostServiceInterface');
		$posts = $postService->findAllPost();
		
		$this->assertInternalType('array', $posts);
		$this->assertNotEmpty($posts);
		$this->assertInstanceOf('Blog\Entity\Post', $posts[0]);
		
	}
	
	/**
	 * @depends testSavePost
	 */
	public function testFindPost($id){
		$postService = $this->serviceLocator->get('Blog\Interfaces\PostServiceInterface');
		$post = $postService->findPost($id);
		
		$this->assertNotNull($post);
		$this->assertNotEmpty($post);
		$this->assertInstanceOf('Blog\Entity\Post', $post);
		
		return $id;
	}
	
	/**
	 * @depends testFindPost
	 */
	public function testDeletePost($id){
		$postService = $this->serviceLocator->get('Blog\Interfaces\PostServiceInterface');
		$post = $postService->findPost($id);
		try {
			$postService->deletePost($post);	
		} catch (Exception $e) {
			$this->fail($e->getMessage());
		}
		
		$post = $postService->findPost($id);
	
		$this->assertNull($post);
		
	}
}