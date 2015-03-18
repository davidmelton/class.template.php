<?php
/**
 * Template Class
 */
class Template {

	public $template;
	public $html;
	public $data = array();
	public $master = '';
	public $path = ''; // system path to templates directory

	function setTemplate( $template )
	{
		$this->template = $template;
	}

	function setData( $placeholder, $value )
	{
		$this->data[$placeholder] = $value;
	}

	function make()
	{
		ob_start();
		require($this->path.$this->master);
		$this->html = ob_get_contents();
		ob_end_clean();

		if(!empty($this->template))
		{
			ob_start();
			include($this->path.$this->template);
			$content = ob_get_contents();
			ob_end_clean();
			$this->html = str_replace('<!--{content}-->', $content, $this->html);
		}

		foreach($this->data as $key => $value)
		{
			$template_name = '<!--{'.$key.'}-->';
			$this->html = str_replace($template_name, $value, $this->html);
		}

		// Cleanup: Delete keys that were not used.
		$this->html = preg_replace("/<!--\{[^-]+\}-->/", '', $this->html);

		// Cleanup: Delete extra line breaks.
		$this->html = preg_replace("/\n{2,}/", "\n", $this->html);

		echo $this->html;
	}
};
