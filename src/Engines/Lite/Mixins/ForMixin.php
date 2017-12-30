<?php
########################################################
# This file is part of phoxphp framework template files.
########################################################
namespace Kit\View\Engines\Lite\Mixins;

use Kit\View\Engines\Lite\Factory;
use Kit\View\Engines\Lite\Compiler;
use Kit\View\Engines\Lite\Mixins\Interfaces\MixinInterface;

class ForMixin implements MixinInterface
{

	/**
	* @var 		$factory
	* @access 	private
	*/
	private 	$factory;

	/**
	* @var 		$template
	* @access 	private
	*/
	private 	$template;

	/**
	* @var 		$directives
	* @access 	private
	*/
	private 	$directives = array();

	/**
	* @var 		$bodyConditionalStatements
	* @access 	private
	*/
	private 	$bodyConditionalStatements = array('@else', '@elseif', '@end');

	/**
	* @var 		$skipFileToString
	* @access 	private
	*/
	private 	$skipFileToString;

	/**
	* @param 	$factory Lite\Factory
	* @param 	$template <String>
	* @param 	$skipFileToString <Boolean>
	* @access 	public
	* @return 	void
	*/
	public function __construct(Factory $factory, $template, $skipFileToString=false)
	{
		$this->factory = $factory;
		$this->template = $template;
		$this->skipFileToString = $skipFileToString;
	}

	/**
	* @access 	public
	* @return 	Boolean
	*/
	public function register()
	{
		return true;
	}

	/**
	* Checks if the template has `if` directive.
	* @access 	protected
	* @return 	Boolean
	* @todo 	Fix whitespace after if statement
	*/
	protected function hasFor()
	{
		$template = ($this->skipFileToString == true) ? $this->template : $this->factory->getTemplateContent($this->template);
		
		$preg = preg_match_all("/@for\((.*)\)/", $template, $matches);
		
		if (!$preg) {
		
			return false;
		
		}

		$this->directives = $matches;
		
		return true;
	}

	/**
	* @param 	$statement <String>
	* @access 	protected
	* @return 	String
	*/
	protected function read($statement='')
	{
		return '<?php for('.$statement.'): ?>';
	}

	/**
	* @access 	public
	* @return 	Array
	*/
	public function getOutput()
	{
		$compiledArray = array();
		
		if ($this->hasFor()) {
		
			foreach($this->directives[0] as $i => $directive) {
		
				$directiveCode = $this->directives[1][$i];
		
				Compiler::addCustomOutput($directive, htmlentities($this->read($directiveCode)));
		
				Compiler::addCustomOutput('@endfor', htmlentities('<?php endfor; ?>'));
		
			}
		}

		return $compiledArray;
	}
	
}