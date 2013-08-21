<?php

use lib\BaseRepoItem;

class TO_General_TextBox
	extends BaseRepoItem
{
	/**
	 * USER_LOGIN input
	 *
	 * @return \lib\Item\WebItem
	 */
	public static function userLogin()
	{
		return self::webElementByXpath("//input[@name='USER_LOGIN']");
	}

	/**
	 * USER_PASSWORD input
	 *
	 * @return \lib\Item\WebItem
	 */
	public static function userPassword()
	{
		return self::webElementByXpath("//input[@name='USER_PASSWORD']");
	}
} 