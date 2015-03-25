<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author w.begbessou
 *         @ORM\Entity (repositoryClass="Blog\Repository\PostRepository")
 *         @ORM\Table (name="blg_post")
 *        
 */
class Post {
	
	/**
	 * @ORM\Id
	 * @ORM\Column (type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 *
	 * @var unknown_type 
	 * @ORM\Column (type="string", length=50)
	 */
	protected $title;
	
	/**
	 *
	 * @var unknown_type 
	 * @ORM\Column (type="text" )
	 */
	protected $text;
	
	/**
	 * @ORM\Column (type="string", length=200, nullable=true)
	 * @var unknown
	 */
	protected $image;
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	
	public function getText() {
		return $this->text;
	}
	
	public function setText($text) {
		$this->text = $text;
		return $this;
	}
	public function getImage() {
		return $this->image;
	}
	public function setImage(unknown $image) {
		$this->image = $image;
		return $this;
	}
	
	
	
	
}