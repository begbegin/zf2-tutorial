<?php
namespace Blog\Repository;

use Doctrine\ORM\EntityRepository;
use Blog\BlogUtils;
use Blog\Entity\Post;
class PostRepository extends EntityRepository{
	
	public function save(Post $post){
		try {
			$this->getEntityManager()->persist($post);
			$this->getEntityManager()->flush();
		} catch (Exception $e) {
			throw new \Exception(); // @codeCoverageIgnore
		}
		
		return BlogUtils::OK;
	}
	
	public function delete(Post $post){
		try {
			$this->getEntityManager()->remove($post);
			$this->getEntityManager()->flush();
		} catch (Exception $e) {
			throw new \Exception(); // @codeCoverageIgnore
		}
	
		return BlogUtils::OK;
	}
}