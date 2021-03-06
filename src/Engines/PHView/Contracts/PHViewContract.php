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
* @package 	Kit\View\Engines\PHView\Contracts\PHViewContract
*/

namespace Kit\View\Engines\PHView\Contracts;

use Kit\View\Engines\PHView\View;

interface PHViewContract
{

	/**
	* This method sets the view repository to use. The view repositories are in the
	* repositories directory.
	*
	* @param 	$repository
	* @access 	public
	* @return 	Kit\View\Engines\PHView\View
	*/
	public function setRepository(String $repository) : View;

	/**
	* Set a variable.
	*
	* @param 	$name <String>
	* @param 	$value <Mixed>
	* @access 	public
	* @return 	Kit\View\Engines\PHView\View
	*/
	public function setVariable(String $key, $value) : View;

	/**
	* Return a variable.
	*
	* @param 	$name <String>
	* @access 	public
	* @return 	Mixed
	*/
	public function getVariable(String $key);

	/**
	* Set layout. This method accepts either a string (name of the layout to use)
	* or an instance of Kit\View\Engines\PHView\Layout.
	*
	* @param 	$layout <String> | <Kit\View\Engines\PHView\Layout>
	* @access 	public
	* @return 	Kit\View\Engines\PHView\View
	*/
	public function setLayout($layout) : View;

	/**
	* Render either a view or layout.
	*
	* @param 	$layout <String>
	* @param 	$view <String>
	* @access 	public
	* @return 	Kit\PHView\View
	*/
	public function render($layout='', $view='') : View;

	/**
	* Set view to render.
	*
	* @param 	$view <String>
	* @access 	public
	* @return 	Kit\View\Engines\PHView\View
	*/
	public function setView(String $view) : View;

	/**
	* Get the view that is being rendered.
	*
	* @access 	public
	* @return 	Kit\View\Engines\PHView\View
	*/
	public function getView();

	/**
	* Get the layout that is being rendered.
	*
	* @access 	public
	* @return 	Kit\View\Engines\PHView\View
	*/
	public function getLayout();

	/**
	* Return the repository in use.
	*
	* @access 	public
	* @return 	String
	*/
	public function getRepository() : String;

}