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
* @package 	Kit\View\Engines\PHView\Repository
*/

namespace Kit\View\Engines\PHView;

use Kit\View\Engines\PHView\View;
use Kit\View\Engines\PHView\Config;
use Kit\View\Engines\PHView\Exceptions\FileNotFoundException;

class Repository
{

	/**
	* @var 		$repository
	* @access 	protected
	*/
	protected 	$repository;

	/**
	* @var 		$directory
	* @access 	protected
	*/
	protected 	$directory;

	/**
	* @param 	$repository <String>
	* @access 	public
	* @return 	void
	*/
	public function __construct(View $view)
	{
		$this->repository = $view->getRepository();
		$this->directory = Config::get('repository_directory') . $this->repository . '/';
	}

	/**
	* Check if a repository has layouts directory.
	*
	* @param 	$repository <String>
	* @access 	public
	* @return 	Boolean
	*/
	public function hasLayouts($repository='')
	{
		$directory = $this->directory;
		$layouts = $directory . 'layouts';
		if (!is_dir($layouts)) {
			return false;
		}

		return true;
	}

	/**
	* Check if a repository has views directory and also checks if the views
	* directory has files.
	*
	* @param 	$repository <String>
	* @access 	public
	* @return 	Boolean
	*/
	public function hasViews($repository='')
	{
		$directory = $this->directory;
		$layouts = $directory . 'views';
		if (!is_dir($layouts)) {
			return false;
		}

		return true;
	}

	/**
	* Returns the repository directory.
	*
	* @param 	$with <String>
	* @access 	public
	* @return 	String
	*/
	public function getDirectory()
	{
		return $this->directory;
	}

	/**
	* Returns a path with the repository directory path.
	* The first parameter @param $with is the path that will be added to the
	* directory path and the second parameter @param $extension is the 
	*
	* @param 	$with <String>
	* @param 	$extension <String>
	* @param 	$checkFile <Boolean>
	* @access 	public
	* @return 	String
	*/
	public function getPathWith(String $with, String $extension='html', Bool $checkFile=false)
	{
		if (gettype($extension) !== 'string') {

			$extension = Config::get('extension');
		
		}

		$extension = '.' . $extension;
		
		if ($checkFile == true) {
		
			if (!file_exists($this->directory . $with . $extension)) {
		
				throw new FileNotFoundException(sprintf('File %s does not exist.', $this->directory . $with . $extension));
		
			}
		
		}

		return $this->directory . $with . $extension;
	}

	/**
	* Return a file path relative to layouts repository directory.
	*
	* @param 	$with <String>
	* @param 	$extension <String>
	* @param 	$checkFile <Boolean>
	* @access 	public
	* @return 	String
	*/
	public function getLayoutsPathWith(String $with, String $extension='', Bool $checkFile=false)
	{
		return $this->getPathWith('layouts/' . $with, $extension, $checkFile);
	}

	/**
	* Return a file path relative to views repository directory.
	*
	* @param 	$with <String>
	* @param 	$extension <String>
	* @param 	$checkFile <Boolean>
	* @access 	public
	* @return 	String
	*/
	public function getViewsPathWith(String $with, String $extension='', Bool $checkFile=false)
	{
		return $this->getPathWith('views/' . $with, $extension, $checkFile);
	}

	/**
	* Return a file path relative to partials repository directory.
	*
	* @param 	$with <String>
	* @param 	$extension <String>
	* @param 	$checkFile <Boolean>
	* @access 	public
	* @return 	String
	*/
	public function getPartialsPathWith(String $with, String $extension='', Bool $checkFile=false)
	{
		return $this->getPathWith('partials/' . $with, $extension, $checkFile);
	}

	/**
	* Return a file path relative to blocks repository directory.
	*
	* @param 	$with <String>
	* @param 	$extension <String>
	* @param 	$checkFile <Boolean>
	* @access 	public
	* @return 	String
	*/
	public function getBlocksPathWith(String $with, String $extension='', Bool $checkFile=false)
	{
		return $this->getPathWith('blocks/' . $with, $extension, $checkFile);
	}

}