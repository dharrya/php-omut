<?php
namespace lib;


use lib\Helper\DocParser;
use lib\Helper\JSErrorHelper;

class BaseTestCase
	extends \PHPUnit_Extensions_Selenium2TestCase
{
	const LOG_TYPE = "browser";
	const BROWSER = "firefox";
	const IMPLICITLY_WAIT = 2;

	protected $baseUrl = "http://stuff-dharrya.rhcloud.com/";
	protected static $isSessionPersistent = false;

	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
		$this->baseUrl = $this->conf()->site()->Url;
	}

	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();
		self::setPersistentSession(true);
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
		parent::setUp();
		if(!$this->isBrowserSupportedByTest())
			$this->markTestSkipped(sprintf("'%s' browser is not supported by this test", self::BROWSER));

		$this->setBrowser("firefox");
		$this->setBrowserUrl($this->baseUrl);
		$this->timeouts()->implicitWait(self::IMPLICITLY_WAIT);
		Runtime::setSession($this->prepareSession());
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

		return !$availableBrowsers || in_array(self::BROWSER, $availableBrowsers);
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