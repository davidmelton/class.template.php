<?php
/**
 * Title: PHP Template Class
 * Documentation: https://github.com/davidmelton/php-template-class
 */

class Template {
	
	private $p;
	private $f;
	private $t;

	public function __construct($t, $p=false, $f=false)
	{
		if($p)
		{
			$this->p = $p;
		}
		if(!$f)
		{
			$this->f = '.html';
		}
		$this->t['parent']['path'] = $this->p.$t.$this->f;
	}

	public function set($t, $v, $c=false)
	{
		if ($c)
		{
			$this->t['children'][$c]['data'][$t] = $v;
		}
		else
		{
			$this->t['parent']['data'][$t] = $v;
		}
	}

	public function child($c, $t)
	{
		$this->t['children'][$c]['path'] = $this->p.$c.$this->f;
		$this->t['children'][$c]['tag'] = $t;
	}

	public function push($e=true)
	{
		if (isset($this->t['children']))
		{
			foreach($this->t['children'] as $c)
			{
				ob_start();

				if (isset($c['data']))
				{
					extract($c['data']);
				}
				require_once($c['path']);

				$$c['tag'] = ob_get_clean();
			}
		}
		
		extract($this->t['parent']['data']);
		
		require_once $this->t['parent']['path'];

		if ($e)
		{
			exit;
		}
	}
}
