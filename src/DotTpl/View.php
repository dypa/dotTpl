<?php
namespace DotTpl;

use \ArrayObject;

class View extends ArrayObject
{
	static protected $templateFileName;

	public function __construct($TemplateFileName)
	{
		if (!is_file($TemplateFileName))
		{
			throw new Exception;
		}
		self::$templateFileName =  $TemplateFileName;
		parent::__construct(array(), ArrayObject::ARRAY_AS_PROPS);
	}

	public function __invoke()
	{
		$args = func_get_args();
		if (!$args)
		{
			throw new Exception;
		}
		$callback = array_shift($args);
		if (!is_callable($callback))
		{
			throw new Exception;
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
			throw new Exception;
		}

		return ob_get_clean();
	}
}
