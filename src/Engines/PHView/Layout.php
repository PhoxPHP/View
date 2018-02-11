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
* @package 	Kit\View\Engines\PHView\Layout
*/

namespace Kit\View\Engines\PHView;

use Kit\View\Engines\PHView\View;

class Layout
{

	/**
	* @var 		$view
	* @access 	protected
	*/
	protected 	$view;

	/**
	* @var 		$layout
	* @access 	protected
	*/
	protected 	$layout;

	/**
	* @var 		$content
	* @access 	protected
	*/
	protected 	$content;

	/**
	* @var 		$viewOutput
	* @access 	protected
	*/
	protected 	$viewOutput;

	/**
	* @param 	$view Kit\View\Engines\PHView\View
	* @param 	$layoutFile <String>
	* @access 	public
	* @return 	void
	*/
	public function __construct(View $view, String $layoutFile, $viewOutput)
	{
		$this->view = $view;
		$this->layout = $view->getLayout();
	}

	/**
	* @access 	protected
	* @return 	String
	*/
	protected function content()
	{

	}

}