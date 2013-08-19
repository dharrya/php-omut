<?php
namespace test\Security\Xss;

use test\Security\SecurityBase;

class XssBase
	extends SecurityBase
{
	const FILE_NAME = "/data.json";
	protected static $fileContent = "";
	protected $cases = array();
	protected $dataKey = "";

	public function getCases()
	{
		if (!self::$fileContent)
			self::$fileContent = file_get_contents(__DIR__.self::FILE_NAME);

		$this->cases = json_decode(self::$fileContent, true);

		if(!isset($this->cases[$this->dataKey]))
			throw new \OutOfRangeException("Data with key '{$this->dataKey}' not found in presented cases.");

		return $this->cases[$this->dataKey];
	}

	public function casesDataProvider()
	{
		return array(array($this->getCases()));
	}

	/** @dataProvider casesDataProvider */
	public function testSimpleXss($testCases)
	{
		foreach($testCases as $case) {
			$url = str_replace(
				"@PARAM@", "window.lalala = 'lala'", $case["Url"]
			);
			$this->url($url);
			$result = $this->execute("return window.lalala? window.lalala: null;");
			$this->assertEquals("lala", $result, "Test with id '{$case["Id"]}' failed :'(");
		}
	}

	protected function getAllCases()
	{
		return $this->cases;
	}
} 