<?php
/**
 * Title: PHP Template Class
 * Author: David Melton
 * Web: http://davidmelton.me
 */

class Template {
	
	private $path;
	private $format;
	private $template = array();


	public function __construct($parent, $path = '', $format = '.html')
	{
		$this->path = $path;
		$this->format = $format;
		$this->template['parent']['path'] = $this->path.$parent.$this->format;
	}


	private function set($name, $value)
	{
		if (($name === false) && is_array($value))
		{
			foreach ($value as $name => $value)
			{
				$data[$name] = $value;
			}
			return $data;
		}

		return $data[$name] = $value;
	}


	public function setParent($name, $value)
	{
		$this->template['parent']['data'] = $this->set($name, $value);
	}


	public function setChild($child, $name, $value)
	{
		$this->template['children'][$child]['data'] = $this->set($name, $value);
	}
	

	public function addChild($child, $placeholder)
	{
		$this->template['children'][$child]['path'] = $this->path.$child.$this->format;
		$this->template['children'][$child]['placeholder'] = $placeholder;
	}


	public function publish()
	{
		if (isset($this->template['children']))
		{
			foreach($this->template['children'] as $child)
			{
				ob_start();
				extract($child['data']);
				require_once($child['path']);
				$$child['placeholder'] = ob_get_clean();
			}
		}
		
		extract($this->template['parent']['data']);
		require_once $this->template['parent']['path'];
	}


	public function debug()
	{
		echo "<hr><pre>Template Variables\n".print_r($this->template, true).'</pre><hr>';
	}
}
