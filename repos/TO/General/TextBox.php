<?php

class TO_General_TextBox
	extends BasicItem
{
	/**
	 * USER_LOGIN input
	 *
	 * @return \lib\WebItem
	 */
	public static function userLogin()
	{
		return self::webElementByXpath("//input[@name='USER_LOGIN']");
	}

	/**
	 * USER_PASSWORD input
	 *
	 * @return \lib\WebItem
	 */
	public static function userPassword()
	{
		return self::webElementByXpath("//input[@name='USER_PASSWORD']");
	}
} 