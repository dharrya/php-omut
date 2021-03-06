<?php
namespace lib;


use PHPUnit_Util_Getopt;

class Loader
	extends \PHPUnit_TextUI_Command
{

	protected static $customOptions = array(
		"env-config=" => "loadEnvConfig"
	);

	public function __construct($customOptions = array())
	{
		if (!empty($customOptions))
			$this->longOptions += $customOptions;
	}

	public static function main($exit = true)
	{
		$command = new Loader(self::$customOptions);
		return $command->run($_SERVER['argv'], $exit);
	}

	public function showHelp()
	{
		parent::showHelp();

		print <<<EOT
  --env-config <json|file>  Load environment configuration (e.g. DBUser credentials) from json-encoded string or file.

EOT;
	}

	protected function loadEnvConfig($configs)
	{
		if(file_exists($configs) && is_file($configs))
			$configs = file_get_contents($configs);

		Config::getInstance()->initFromJson($configs);
	}
} 