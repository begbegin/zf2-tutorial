<?php
namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * 
 * @author w.begbessou
 *@ORM\Entity (repositoryClass="Blog\Repository\EnfantRepository")
 *@ORM\Table (name="blg_enfant")
 */
class Enfant{
	
	/**
	 * @ORM\Id
	 * @ORM\Column (type="integer")
	 * @ORM\GeneratedValue (strategy="AUTO")
	 * @var unknown
	 */
	protected $id;
	
	/**
	 * @ORM\Column (type="string")
	 * @var unknown
	 */
	protected $firstName;
	
	/**
	 * @ORM\Column (type="string")
	 * @var unknown
	 */
	protected $name;
	
	/**
	 * @ORM\Column (type="string")
	 * @var unknown
	 */
	protected $schoolYear;
	
	/**
	 * @ORM\Column (type="string")
	 * @var unknown
	 */
	protected $photo;
	
	/**
	 * @ORM\Column (type="date")
	 * @var unknown
	 */
	protected $naissance;
	
	/**
	 * @ORM\Column (type="string")
	 * @var unknown
	 */
	protected $country;
	
	/**
	 * @ORM\Column (type="string")
	 * @var unknown
	 */
	protected $ref;
	
	/**
	 * @ORM\Column (type="string")
	 * @var unknown
	 */
	protected $schoolName;
	
	/**
	 * @ORM\Column (type="string")
	 * @var unknown
	 */
	protected $schoolLevel;
	
	/**
	 * @ORM\Column (type="text")
	 * @var unknown
	 */
	protected $familyConstraints;
	public function getId() {
		return $this->id;
	}
	public function setId( $id) {
		$this->id = $id;
		return $this;
	}
	public function getFirstName() {
		return $this->firstName;
	}
	public function setFirstName( $firstName) {
		$this->firstName = $firstName;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	public function setName( $name) {
		$this->name = $name;
		return $this;
	}
	public function getSchoolYear() {
		return $this->schoolYear;
	}
	public function setSchoolYear( $schoolYear) {
		$this->schoolYear = $schoolYear;
		return $this;
	}
	public function getPhoto() {
		return $this->photo;
	}
	public function setPhoto( $photo) {
		$this->photo = $photo;
		return $this;
	}
	public function getNaissance() {
		return $this->naissance;
	}
	public function setNaissance( $naissance) {
		$this->naissance = $naissance;
		return $this;
	}
	public function getCountry() {
		return $this->country;
	}
	public function setCountry( $country) {
		$this->country = $country;
		return $this;
	}
	public function getRef() {
		return $this->ref;
	}
	public function setRef( $ref) {
		$this->ref = $ref;
		return $this;
	}
	public function getSchoolName() {
		return $this->schoolName;
	}
	public function setSchoolName( $schoolName) {
		$this->schoolName = $schoolName;
		return $this;
	}
	public function getSchoolLevel() {
		return $this->schoolLevel;
	}
	public function setSchoolLevel( $schoolLevel) {
		$this->schoolLevel = $schoolLevel;
		return $this;
	}
	public function getFamilyConstraints() {
		return $this->familyConstraints;
	}
	public function setFamilyConstraints( $familyConstraints) {
		$this->familyConstraints = $familyConstraints;
		return $this;
	}
	
	
	
}