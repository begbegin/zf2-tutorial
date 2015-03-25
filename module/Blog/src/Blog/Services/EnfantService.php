<?php
namespace Blog\Services;

use Blog\Repository\EnfantRepository;
class EnfantService{
	protected $enfantRepo;
	public function __construct(EnfantRepository $enfantRepo){
		$this->enfantRepo = $enfantRepo;
	}
	
	
	public function findAllEnfants(){
		return $this->enfantRepo->findAll();
	}
	
	public function findById($id){
		return $this->enfantRepo->find($id);
	}
}