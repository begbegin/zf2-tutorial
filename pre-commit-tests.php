<?php
class PreCommitTest{
	const ALL_MODULE = "all";
	
	public function __construct(){
		$this->testsFor("Album");
		$this->testsFor("Blog");

		/*  For all Modules testing 
		*	Put this in the comments if you want to test module by module
		*/
		//$this->testsFor(self::ALL_MODULE);
	}
	
	public function testsFor($module){
		$phpunit = 'D:\Users\w.begbessou\AppData\Roaming\Composer\vendor\bin\phpunit';
		echo PHP_EOL;
		echo '>> Unit tests for '.$module.' Module ongoing...' . PHP_EOL;
		echo PHP_EOL;
		
		if(self::ALL_MODULE == $module){
			exec($phpunit, $output, $returnCode); 
		}else{
			exec('phpunit -c ./module/'.$module.'/test/phpunit.xml', $output, $returnCode); 
		}
		
		echo implode(PHP_EOL, $output).PHP_EOL;

		echo PHP_EOL;
		echo '>> End unit tests for '.$module.' Module' . PHP_EOL;
		echo PHP_EOL;

		if($returnCode !== 0 )die($returnCode);
	}
}

new PreCommitTest();
