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

	public function setUp()
	{
//		foo:initBar("lala");
//		die('sss');
//		$this->setBrowser("chrome");
//
//		die(var_dump($this->baseUrl));
//		$this->setBrowserUrl($this->baseUrl);
	}

	public function tearDown()
	{
		$jsErrors = $this->log(self::LOG_TYPE);
		if (!empty($jsErrors))
			$this->logJsErrors($jsErrors);
	}

	protected function runTest()
	{
		printf(
			"----------Starting test '%s'---------\n",
			$this->getTestId()
		);

		parent::runTest();
	}

	protected function logJsErrors(array $jsErrors)
	{
		printf(
			"Oooops, some JS Error on page: %s\nErrors messages:\n",
			$this->url()
		);
		foreach($jsErrors as $i => $error)
		{
			printf("%d: \x1B[31m %s \x1B[0m \n", $i, $error["message"]);
		}
	}
}