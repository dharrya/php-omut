<?php
namespace lib;


use lib\Helper\JSErrorHelper;

class BaseTestCase
	extends \PHPUnit_Extensions_Selenium2TestCase
{

	const LOG_TYPE = "browser";

	protected $baseUrl = "http://stuff-dharrya.rhcloud.com/";

	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
		$this->baseUrl = $this->conf()->site()->Url;
	}

	/**
	 *
	 */
	public static function setUpBeforeClass()
	{
		self::shareSession(true);

	}

	/**
	 *
	 */
	public function setUp()
	{
		$this->setBrowser("chrome");
		$this->setBrowserUrl($this->baseUrl);
		Runtime::setSession($this->prepareSession());
	}

	/**
	 * @param null|string $value
	 * @return string|void
	 */
	public function url($value = null)
	{
		if ($value)
			$this->addMessage(sprintf("Пытаемся открыть урл: %s", $value));

		return parent::url($value);
	}

	/**
	 *
	 */
	public function tearDown()
	{
		$jsErrors = $this->log(self::LOG_TYPE);
		$jsErrors = JSErrorHelper::filterErrors($jsErrors);
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
	 * @return Config
	 */
	protected function conf()
	{
		return Config::getInstance();
	}

	/**
	 * @return DataBase
	 */
	protected function db()
	{
		return DataBase::getInstance();
	}

	/**
	 * @param $message
	 */
	protected function addMessage($message)
	{
		Logger::addMessage($message);
	}
}