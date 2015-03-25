<?php
namespace Blog\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Blog\Services\EnfantService;
class EnfantController extends AbstractActionController{
	protected $enfantService;
	
	public function __construct(EnfantService $enfantService){
		$this->enfantService = $enfantService;
	}
}