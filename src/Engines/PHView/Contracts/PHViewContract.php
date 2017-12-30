<?php
/**
* @package 	Kit\PHView\View
* @author 	Peter Taiwo
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