<?php
namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Services\PostService;
use PhpOffice\PhpWord\PhpWord;
use Blog\Services\EnfantService;
use Blog\Entity\Enfant;
class PrintController extends AbstractActionController{
	
	protected $postService;
	protected $enfantService;
	public function __construct(PostService $postService, EnfantService $enfantService){
		$this->postService = $postService;
		$this->enfantService = $enfantService;
	}
	public function enfantAction(){
		$id = $this->params()->fromRoute('id');
		
		$enfant = $this->enfantService->findById($id);
		if (null == $enfant) return $this->redirect()->toRoute('post');
		//$enfant = new Enfant();
		$phpWord = new PhpWord();
		$section = $phpWord->addSection(
				array(
						'colsNum'   => 2,
						'colsSpace' => 1000,
						'breakType' => 'continuous',
				)
		);
		
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('Prénom : ', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(htmlspecialchars($enfant->getFirstName(), ENT_COMPAT, 'ISO-8859-1'));
		
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('Nom : ', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(htmlspecialchars($enfant->getName(), ENT_COMPAT, 'ISO-8859-1'));
		
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('Date de naissance : ', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(htmlspecialchars($enfant->getNaissance()->format('d.m.Y'), ENT_COMPAT, 'ISO-8859-1'));
		
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('Pays : ', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(htmlspecialchars($enfant->getCountry(), ENT_COMPAT, 'ISO-8859-1'));
		
		$section->addTextBreak();
		
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('Référence : ', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(htmlspecialchars($enfant->getRef(), ENT_COMPAT, 'ISO-8859-1'));
		
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('Ecole : ', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(htmlspecialchars($enfant->getSchoolName(), ENT_COMPAT, 'ISO-8859-1'));
		
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('Classe : ', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(htmlspecialchars($enfant->getSchoolLevel(), ENT_COMPAT, 'ISO-8859-1'));
		
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('	Année scolaire ', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(htmlspecialchars($enfant->getSchoolYear(), ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		
		$section->addTextBreak();
		
		$section->addImage('.'.$enfant->getPhoto(), array('width' => 150, 'height' => 150, 'align' => 'center'));
		$section = $phpWord->addSection(array('breakType' => 'continuous'));
		
		$section->addTextBreak();
		
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('Situation familiale : ', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(utf8_encode($enfant->getFamilyConstraints()));
		echo $enfant->getFamilyConstraints();
		$section->addTextBreak();
		
		$section->addImage('./public/img/logo.png', array('width' => 300, 'height' => 80, 'align' => 'left'));
		$textrun = $section->addTextRun();
		$textrun->addText(htmlspecialchars('Association Croissance Afrique', ENT_COMPAT, 'ISO-8859-1'), array('bold' => true));
		$textrun->addText(htmlspecialchars(' - case postale 4 - CH-2740 Moutier', ENT_COMPAT, 'ISO-8859-15'),  array('size' => 8));
		$section->addText(htmlspecialchars('T +41 32 492 33 20 - +41 79 303 61 71 - croissance.afrique@gmail.com', ENT_COMPAT, 'ISO-8859-1'),  array('size' => 8));
		$section->addText(htmlspecialchars('www.croissance-afrique.org - CCP 17-133026-0', ENT_COMPAT, 'ISO-8859-1'),  array('size' => 8));
		
		$writers = array('Word2007' => 'docx',);
		echo $this->write($phpWord, basename(__FILE__, '.php'), $writers);
		
		/*$source = realpath("./public/docs/PrintController.html");
		$phpWord = \PhpOffice\PhpWord\IOFactory::load($source, 'HTML');
		
		$writers = array('Word2007' => 'docx');
		echo $this->write($phpWord, basename(__FILE__, '.php'), $writers);*/
	}
	

	public function printToWordAction(){
		$phpWord = new PhpWord();
		
	//include_once 'Sample_Header.php';

// New Word Document
//echo date('H:i:s') , ' Create new PhpWord object' , EOL;
//$phpWord = new \PhpOffice\PhpWord\PhpWord();
$phpWord->addFontStyle('rStyle', array('bold' => true, 'italic' => true, 'size' => 16, 'allCaps' => true, 'doubleStrikethrough' => true));
$phpWord->addParagraphStyle('pStyle', array('align' => 'center', 'spaceAfter' => 100));
$phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));

// New portrait section
$section = $phpWord->addSection();

// Simple text
$section->addTitle(htmlspecialchars('Welcome to PhpWord'), 1);
$section->addText(htmlspecialchars('Hello World!'));


// Two text break
$section->addTextBreak(2);

// Defined style
$section->addText(htmlspecialchars('I am styled by a font style definition.'), 'rStyle');
$section->addText(htmlspecialchars('I am styled by a paragraph style definition.'), null, 'pStyle');
$section->addText(htmlspecialchars('I am styled by both font and paragraph style.'), 'rStyle', 'pStyle');

$section->addTextBreak();

// Inline font style
$fontStyle['name'] = 'Times New Roman';
$fontStyle['size'] = 20;

$textrun = $section->addTextRun();
$textrun->addText(htmlspecialchars('I am inline styled '), $fontStyle);
$textrun->addText(htmlspecialchars('with '));
$textrun->addText(htmlspecialchars('color'), array('color' => '996699'));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('bold'), array('bold' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('italic'), array('italic' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('underline'), array('underline' => 'dash'));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('strikethrough'), array('strikethrough' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('doubleStrikethrough'), array('doubleStrikethrough' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('superScript'), array('superScript' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('subScript'), array('subScript' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('smallCaps'), array('smallCaps' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('allCaps'), array('allCaps' => true));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('fgColor'), array('fgColor' => 'yellow'));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('scale'), array('scale' => 200));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('spacing'), array('spacing' => 120));
$textrun->addText(htmlspecialchars(', '));
$textrun->addText(htmlspecialchars('kerning'), array('kerning' => 10));
$textrun->addText(htmlspecialchars('. '));

// Link
$section->addLink('http://www.google.com', htmlspecialchars('Google'));
$section->addTextBreak();

// Image
//$section->addImage('resources/_earth.jpg', array('width'=>18, 'height'=>18));

$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html');

// Set PDF renderer
/*if (null === Settings::getPdfRendererPath()) {
	$writers['PDF'] = null;
}*/

// Save file
echo $this->write($phpWord, basename(__FILE__, '.php'), $writers);
/*if (!CLI) {
    include_once 'Sample_Footer.php';
}*/
	}
	
	function write($phpWord, $filename, $writers)
	{
		$result = '';
	
		// Write documents
		foreach ($writers as $format => $extension) {
			$result .= date('H:i:s') . " Write to {$format} format";
			if (null !== $extension) {
				$targetFile = "./public/docs/{$filename}.{$extension}";
				$phpWord->save($targetFile, $format);
			} else {
				$result .= ' ... NOT DONE!';
			}
			//$result .= EOL;
		}
	
		//$result .= $this->getEndingNotes($writers);
	
		return $result;
	}
	
	function getEndingNotes($writers)
	{
		$result = '';
	
		// Do not show execution time for index
		if (!IS_INDEX) {
			$result .= date('H:i:s') . " Done writing file(s)" . EOL;
			$result .= date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB" ;
		}
	
		// Return
		if (CLI) {
			$result .= 'The results are stored in the "results" subdirectory.' ;
		} else {
			if (!IS_INDEX) {
				$types = array_values($writers);
				$result .= '<p>&nbsp;</p>';
				$result .= '<p>Results: ';
				foreach ($types as $type) {
					if (!is_null($type)) {
						$resultFile = 'results/' . SCRIPT_FILENAME . '.' . $type;
						if (file_exists($resultFile)) {
							$result .= "<a href='{$resultFile}' class='btn btn-primary'>{$type}</a> ";
						}
					}
				}
				$result .= '</p>';
			}
		}
	
		return $result;
	}
}