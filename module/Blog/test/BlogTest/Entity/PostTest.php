<?php
namespace BlogTest\Entity;

use Blog\Entity\Post;
class PostTest extends \PHPUnit_Framework_TestCase{
	
	public function testPostInitialStateShouldbeNull(){
		$post = new Post();
		
		$this->assertNull($post->getId(), '"id" doit être null');
		$this->assertNull($post->getTitle(), '"title" doit être null');
		$this->assertNull($post->getText(), '"text" doit être null');
		$this->assertNull($post->getImage(), '"image" doit être null');
	}
}