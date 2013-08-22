<?php
namespace lib;

use lib\Exception\ConfigNotFound;

/**
 * Class Config
 * @package lib
 * @property array $Browser
 * @property array $DB
 * @property array $Site
 */
class Config
{
	const CONFIG_DB = "DB";
	const CONFIG_SITE = "Site";
	const CONFIG_BROWSER = "Browser";
	const DEFAULT_CONFIGS = '{
		"Browser": {
			"browserName": "firefox",
			"host": "localhost",
			"port": 4444,
			"browser": null,
			"desiredCapabilities": [],
			"seleniumServerRequestsTimeout": 60,
			"sessionStrategy": "shared"
		},
		"DB": {
			"Type": "Mysql",
			"Host": "localhost:3306",
			"DBName": "",
			"User": "root",
			"Password": ""
		},
		"Site": {
			"Url": "http://localhost/",
			"UserName": "",
			"Password": ""
		}
	}';
	const DEFAULT_FILE_PATH = 'env.json';
	protected static $instance = null;

	/** @var array $configs  */
	protected $configs = null;


	public function __get($type)
	{
		return $this->getConfig($type);
	}


	public function __isset($type)
	{
		return isset($this->configs[$type]);
	}

	/**
	 * @param string $type
	 * @return array
	 * @throws Exception\ConfigNotFound
	 */
	public function getConfig($type)
	{
		if (!isset($this->configs[$type]))
			throw new ConfigNotFound("Config entry '{$type}' not present in configuration or not loaded propertly");

		return $this->configs[$type];
	}

	/**
	 * @param string $configString
	 */
	public function initFromJson($configString)
	{
		$this->configs = json_decode($configString);
	}

	/**
	 * @return Config
	 */
	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = new Config();

		return self::$instance;
	}

	private function __construct()
	{
		$this->configs = json_decode(self::DEFAULT_CONFIGS, true);

		$userConfigs = array();
		if (file_exists(self::DEFAULT_FILE_PATH) && is_file(self::DEFAULT_FILE_PATH)) {
			$userConfigs = json_decode(file_get_contents(self::DEFAULT_FILE_PATH), true);
		}
		$this->replaceSettings($userConfigs);
	}

	protected function replaceSettings($settings)
	{
		if (!is_array($settings))
			return;

		foreach($settings as $type => $setting) {
			if (is_array($setting)) {
				foreach($setting as $key => $value) {
					$this->configs[$type][$key] = $value;
				}
			} else {
				$this->configs[$type] = $setting;
			}
		}
	}

	private function __clone() {}
	private function __wakeup() {}
}