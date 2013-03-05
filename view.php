<?php
namespace dotTpl;

use \ArrayObject;

class View extends ArrayObject
{
	static protected $templateFileName;

	public function __construct($TemplateFileName)
	{
		if (!is_file($TemplateFileName))
		{
			throw new dotTplException;
		}
		self::$templateFileName =  $TemplateFileName;
		parent::__construct(array(), ArrayObject::ARRAY_AS_PROPS);
	}

	public function __invoke()
	{
		$args = func_get_args();
		if (!$args)
		{
			throw new dotTplException;
		}
		$callback = array_shift($args);
		if (!is_callable($callback))
		{
			throw new dotTplException;
		}

		return call_user_func_array($callback, $args);
	}

	public function __toString()
	{
		extract($this->getArrayCopy(), EXTR_REFS);
		$_ = $this;
		ob_start();

		try
		{
			include self::$templateFileName;
		}
		catch (Exception $e)
		{
			throw new dotTplException;
		}

		return ob_get_clean();
	}
}
