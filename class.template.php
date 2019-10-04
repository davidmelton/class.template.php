<?php
/**
 * Title: PHP Template Class
 * Author: David Melton
 * Web: http://davidmelton.me
 */

class Template {
	
	private $master;
	private $html;
	private $path;
	private $children = array();
	private $data = array();
	private $type = '.html';

	public function __construct($template, $path = '')
	{
		$this->path = $path;
		$this->master = $this->path.$template.$this->type;
	}

	
	// set child templates
	public function child($placeholder, $template)
	{
		$this->children[$placeholder] = $this->path.$template.$this->type;
	}

	
	// takes a template fragment and repeats it
	// with the result of a databse query or a
	// multidimensional array
	public function repeater($placeholder, $template, array $result)
	{
		ob_start();
		require_once($this->path.$template.$this->type);
		$template = ob_get_clean();
		$repeater = '';
		
		foreach ($result as $row)
		{
			$html = $template;
			foreach ($row as $key => $value)
			{
				$data = '<!--{'.$key.'}-->';
				$html = str_replace($data, $value, $html);
			}
			$repeater .= $html;
		}
		$this->set($placeholder, $repeater);
		unset($template, $html, $result);
	}

	
	// set the value of template placeholders
	public function set($placeholder, $data)
	{
		if (($placeholder === false) && is_array($data))
		{
			foreach ($data as $key => $value)
			{
				$this->data[$key] = $value;
			}
		}
		else
		{
			$this->data[$placeholder] = $data;
		}
	}

	
	// output the final html template
	public function publish()
	{
		// include master template
		ob_start();
		require_once($this->master);
		$this->html = ob_get_clean();

		// include child templates
		if(!empty($this->children))
		{
			foreach($this->children as $placeholder => $template)
			{
				ob_start();
				require_once($template);
				$child = ob_get_clean();
				$this->html = str_replace('<!--{'.$placeholder.'}-->', $child, $this->html);
			}
		}

		// replace template placeholders with data
		foreach($this->data as $placeholder => $value)
		{
			$this->html = str_replace('<!--{'.$placeholder.'}-->', $value, $this->html);
		}

		// delete unused placeholders
		$this->html = preg_replace("/<!--\{[^-]+\}-->/", '', $this->html);

		// remove extra white space
		$this->html = preg_replace('/^\h*\v+/m', '', $this->html);

		echo $this->html;
	}
}
