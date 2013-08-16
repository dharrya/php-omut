<?php

class TO_General_TextBox
	extends BasicItem
{
	/**
	 * @return \lib\NullWebItem|\lib\WebItem
	 */
	public static function userLogin()
	{
		return self::webElementByXpath("//input[@name='USER_LOGIN']");
	}

	public static function userPassword()
	{
		return self::webElementByXpath("//input[@name='USER_PASSWORD']");
	}
} 