<?php
namespace lib;


class BaseTestCase
	extends \PHPUnit_Extensions_Selenium2TestCase
{

	const LOG_TYPE = "browser";

	protected $baseUrl = "http://stuff-dharrya.rhcloud.com/";

	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
		$this->setBrowser("chrome");
		$this->setBrowserUrl($this->baseUrl);
		Runtime::setSession($this->prepareSession());
	}

	public static function setUpBeforeClass()
	{
		self::shareSession(true);
	}

	public function url($value = null)
	{
		if ($value)
			$this->addMessage(sprintf("Пытаемся открыть урл: %s", $value));

		return parent::url($value);
	}

	public function tearDown()
	{
		$jsErrors = $this->log(self::LOG_TYPE);
		if (!empty($jsErrors)) {
			$this->addMessage(
				sprintf(
					"Browser Error occurred on page: %s\nErrors messages: %s",
					$this->url(), json_encode($jsErrors)
				)
			);
		}
	}

	/**
	 * @return DataBase
	 */
	protected function db()
	{
		return DataBase::getInstance();
	}

	protected function addMessage($message)
	{
		Logger::addMessage($message);
	}
}