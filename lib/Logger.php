<?php
namespace lib;

class Logger
	implements \PHPUnit_Framework_TestListener
{
	private static $filePath = "";

	public function __construct($directory)
	{
		self::$filePath = $directory."/execution_".date("d-m-Y\TH-i-s").".log";
	}

	public static function addMessage($message)
	{
		self::store($message);
	}

	public function addError(\PHPUnit_Framework_Test $test, \Exception $e, $time)
	{
		self::store(
			sprintf("Error while running test '%s'. Message: %s.\nTrace:\n%s", $test->getName(), $e->getMessage(), $e->getTraceAsString())
		);
	}

	public function addFailure(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_AssertionFailedError $e, $time)
	{
		self::store(
			sprintf("Test '%s' failed. Message: %s.\nTrace:\n%s", $test->getName(), $e->getMessage(), $e->getTraceAsString())
		);
	}

	public function addIncompleteTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
	{
		self::store(
			sprintf("Test '%s' is incomplete. Message: %s", $test->getName(), $e->getMessage())
		);
	}

	public function addSkippedTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
	{
		self::store(
			sprintf("Test '%s' has been skipped.", $test->getName())
		);
	}

	public function startTest(\PHPUnit_Framework_Test $test)
	{
		self::store(
			sprintf("Test '%s' started.", $test->getName())
		);
	}

	public function endTest(\PHPUnit_Framework_Test $test, $time)
	{
		self::store(
			sprintf("Test '%s' ended.", $test->getName())
		);
	}

	public function startTestSuite(\PHPUnit_Framework_TestSuite $suite)
	{
		self::store(
			sprintf("TestSuite '%s' started.", $suite->getName())
		);
	}

	public function endTestSuite(\PHPUnit_Framework_TestSuite $suite)
	{
		self::store(
			sprintf("TestSuite '%s' ended.", $suite->getName())
		);
	}

	protected static function store($text)
	{
		$message = sprintf(
			"%s ----- %s \n",
			date("H:i:s"), $text
		);

		file_put_contents(self::$filePath, $message, FILE_APPEND);
	}
}