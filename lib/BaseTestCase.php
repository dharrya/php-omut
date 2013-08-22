<?php
namespace lib;


use lib\Helper\DocParser;
use lib\Helper\JSErrorHelper;

class BaseTestCase
	extends \PHPUnit_Extensions_Selenium2TestCase
{
	const LOG_TYPE = "browser";
	const IMPLICITLY_WAIT = 2;

	protected static $isSessionPersistent = false;
	protected static $baseUrl = "http://stuff-dharrya.rhcloud.com/";
	protected static $initialized = false;

	public static function setUpBeforeClass()
	{
		if (self::$initialized)
			return;

		self::$baseUrl = Config::getInstance()->Site["Url"];
	}

	public static function setPersistentSession($isPersistent)
	{
		if(self::$isSessionPersistent == $isPersistent)
			return;

		self::shareSession($isPersistent);
		self::$isSessionPersistent = $isPersistent;
	}

	public function setUp()
	{
		if($this->getBrowser() && !$this->isBrowserSupportedByTest())
			$this->markTestSkipped(sprintf("'%s' browser is not supported by this test", $this->getBrowser()));

		$this->setupSpecificBrowser($this->conf()->Browser);
		$this->setBrowserUrl(self::$baseUrl);
		Runtime::setSession($this->prepareSession());
		$this->timeouts()->implicitWait(self::IMPLICITLY_WAIT);
	}

	public function tearDown()
	{
		parent::tearDown();
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
	 * @return string
	 */
	public function getBrowser()
	{
		$result = parent::getBrowser();
		if (!$result)
			$result = $this->conf()->Browser["browserName"];

		return $result;
	}

	/**
	 * @param null|string $value
	 * @return string|void
	 */
	public function url($value = null)
	{
		if ($value)
			$this->addMessage(sprintf("Открываем урл: %s", $value));

		return parent::url($value);
	}

	/**
	 * @param string $jsCode
	 * @param array $args
	 * @return string
	 */
	public function execute($jsCode, $args = array())
	{
		return parent::execute(
			array(
				"script" => $jsCode,
				"args" => $args
			)
		);
	}

	/**
	 * @param string $jsCode
	 * @param array $args
	 * @return string
	 */
	public function executeAsync($jsCode, $args = array())
	{
		return parent::executeAsync(
			array(
				"script" => $jsCode,
				"args" => $args
			)
		);
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

	/**
	 * @return bool
	 */
	protected function isBrowserSupportedByTest()
	{
		$availableBrowsers = $this->getAvailableBrowsers();

		return !$availableBrowsers || in_array($this->getBrowser(), $availableBrowsers);
	}

	/**
	 * @return array
	 */
	protected function getAvailableBrowsers()
	{
		$testAnnotationValue = DocParser::getMethodTagValue(
			get_class($this),
			$this->getName(),
			'browser'
		);
		if($testAnnotationValue) {
			$browsers = explode(",", $testAnnotationValue);
			foreach($browsers as &$browser) {
				$browser = trim($browser);
			}
			unset($browser);
		} else {
			$browsers = false;
		}


		return $browsers;
	}
}