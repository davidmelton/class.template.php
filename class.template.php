<?php
/**
 * Title: PHP Template Class
 * Author: David Melton
 * Web: http://davidmelton.me
 */

class Template {
	
	private $master;
	private $child;
	private $html;
	private $path;
	private $data = array();
	private $type = '.php';

	public function __construct($template, $path)
	{
		$this->path = $path;
		$this->master = $this->path.$template.$this->type;
	}

	
	// defines an embedded template
	public function child($template)
	{
		$this->child = $this->path.$template.$this->type;
	}

	
	// takes a template fragment and repeats it with a data result
	public function repeater($template, $placeholder, array $result)
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
		if ( is_array( $data ))
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

		// include child template
		if(!empty($this->child))
		{
			ob_start();
			require_once($this->child);
			$content = ob_get_clean();
			$this->html = str_replace('<!--{content}-->', $content, $this->html);
		}

		// replace template placeholders with data
		foreach($this->data as $key => $value)
		{
			$data = '<!--{'.$key.'}-->';
			$this->html = str_replace($data, $value, $this->html);
		}

		// delete unused placeholders
		$this->html = preg_replace("/<!--\{[^-]+\}-->/", '', $this->html);

		// remove extra line breaks
		$this->html = preg_replace("/\n{2,}/", "\n", $this->html);

		echo $this->html;
	}
}
