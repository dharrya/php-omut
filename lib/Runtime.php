<?php
namespace lib;


class Runtime
{

	/** @var \PHPUnit_Extensions_Selenium2TestCase_Session $session */
	protected static $session = null;

	/**
	 * @param \PHPUnit_Extensions_Selenium2TestCase_Session $session
	 */
	public static function setSession(\PHPUnit_Extensions_Selenium2TestCase_Session $session)
	{
		self::$session = $session;
	}

	/**
	 * @return \PHPUnit_Extensions_Selenium2TestCase_Session
	 */
	public static function session()
	{
		return self::$session;
	}
} 