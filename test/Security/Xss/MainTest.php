<?php
namespace test\Security\Xss;

class MainTest
	extends XssBase
{
	protected $dataKey = "Main";

	/** @dataProvider casesDataProvider */
	public function testSimpleXss($testCases)
	{
		parent::testSimpleXss($testCases);
	}
} 