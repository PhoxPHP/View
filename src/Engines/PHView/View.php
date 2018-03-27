<?php
/**
* MIT License
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:

* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.

* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*/

/**
* @author 	Peter Taiwo
* @version 	1.0.0
* @package 	Kit\View\Engines\PHView\View
*/

namespace Kit\View\Engines\PHView;

use RuntimeException;
use Kit\View\Engines\PHView\Config;
use Kit\View\Engines\PHView\Layout;
use Kit\View\Engines\PHView\Repository;
use Kit\View\Engines\PHView\Block\Block;
use Kit\View\Engines\PHView\Renderer\Renderer;
use Kit\View\Engines\PHView\Contracts\PHViewContract;
use Kit\View\Engines\PHView\Exceptions\FileNotFoundException;

class View implements PHViewContract
{

	/**
	* @var 		$layout
	* @access 	protected
	*/
	protected 	$layout = null;

	/**
	* @var 		$view
	* @access 	protected
	*/
	protected 	$view = null;

	/**
	* @var 		$variables
	* @access 	protected
	*/
	protected 	$variables;

	/**
	* @var 		$repository
	* @access 	protected
	*/
	protected 	$repository = 'default';

	/**
	* @var 		$content
	* @access 	protected
	*/
	protected 	$content;

	/**
	* @var 		$blocks
	* @access 	protected
	*/
	protected 	$blocks = [];

	/**
	* @var 		$block
	* @access 	protected
	*/
	protected 	$block;

	/**
	* @var 		$blockOpen
	* @access 	protected
	*/
	protected 	$blockOpen = false;

	/**
	* The construct accepts three arguments. $layout []
	*
	* @param 	$layout <String>
	* @param 	$view <String>
	* @param 	$variables <Array>
	* @access 	public
	* @return 	void
	*/
	public function __construct($layout='', $view='', $variables=[])
	{
		$this->view = $view;
		$this->layout = $layout;
		$this->variables = $variables;
	}

	/**
	* {@inheritDoc}
	*/
	public function setRepository(String $repository) : View
	{
		$this->repository = $repository;
		return $this;
	}

	/**
	* {@inheritDoc}
	*/
	public function setVariable(String $name, $value) : View
	{
		$this->variables[$name] = $value;
		return $this;
	}

	/**
	* {@inheritDoc}
	*/
	public function getVariable(String $name)
	{
		return $this->variables[$name] ?? null;
	}

	/**
	* {@inheritDoc}
	*/
	public function render($view='', $layout='') : View
	{
		if (sizeof(array_keys($this->variables)) > 0) {
			// We will only parse variables if any variable has been added.
			foreach(array_keys($this->variables) as $variable) {

				$$variable = $this->variables[$variable];
			
			}
		}

		if ($layout !== '') {

			$this->layout = $layout;
		
		}

		if ($view !== '') {
			$this->view = $view;
		}

		$repositoryDirectory = Config::get('repository_directory');

		$repository = new Repository($this);

		if (!$repository->hasLayouts()) {

			throw new FileNotFoundException(sprintf('Directory %s does not exist.', $repositoryDirectory . 'layouts'));
		
		}

		if (!$repository->hasViews()) {
		
			throw new FileNotFoundException(sprintf('Directory %s does not exist.', $repositoryDirectory . 'views'));
		
		}

		if ($this->view !== null && $this->view !== '') {
		
			$viewFile = $repository->getViewsPathWith($this->view, Config::get('extension'), true);
		
			$viewOutput = file_get_contents($viewFile);
		
			$this->content = $viewOutput;

			if ($this->layout == null || $this->layout == '') {
		
				eval("?> $viewOutput <?php ");

				return $this;
		
			}
		
		}

		if ($this->layout !== null && $this->layout !== '' && $this->view !== null && $this->view !== '') {
		
			$layoutFile = $repository->getLayoutsPathWith($this->layout, Config::get('extension'), true);
		
			$layoutOutput = file_get_contents($layoutFile);

			eval("?> $layoutOutput <?php ");
		}

		return $this;
	}

	/**
	* {@inheritDoc}
	*/
	public function setLayout($layout) : View
	{
		if (gettype($layout) !== 'string' || !$layout instanceof Layout) {
			
			throw new RuntimeException('Layout can either be string or instance of PHView\\Layout');
		
		}

		$this->layout = $layout;

		return $this;
	}

	/**
	* {@inheritDoc}
	*/
	public function setView(String $view) : View
	{
		return $this;
	}

	/**
	* {@inheritDoc}
	*/
	public function getView()
	{
		return $this->view;
	}

	/**
	* {@inheritDoc}
	*/
	public function getLayout()
	{
		return $this->layout;
	}

	/**
	* {@inheritDoc}
	*/
	public function getRepository() : String
	{
		return $this->repository;
	}

	/**
	* @access 	protected
	* @return 	String
	*/
	protected function content()
	{
		return $this->content;
	}

	/**
	* Renders a partial template.
	*
	* @param 	$partial <String>
	* @param 	$variables <Array>
	* @access 	protected
	* @return 	String
	*/
	protected function partial(String $partial, Array $variables=[])
	{
		if (sizeof(array_keys($variables)) > 0) {

			foreach(array_keys($variables) as $variable) {
			
				$$variable = $variables[$variable];
			
			}
		
		}

		$repository = new Repository($this);
		
		$partialFile = $repository->getPartialsPathWith($partial, Config::get('extension'), true);
		
		$partialOutput = file_get_contents($partialFile);

		eval("?> $partialOutput <?php ");
	}

}