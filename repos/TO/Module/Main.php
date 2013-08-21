<?php

use lib\BaseRepoItem;

class TO_Module_Main
	extends BaseRepoItem
{

	/**
	 * @readable Форма логина
	 * @return \lib\Item\WebItem
	 */
	public static function loginForm()
	{
		$path = "//div[contains(@class, 'bx-system-auth-form')]/form[@action='/?login=yes']";
		return self::webElementByXpath($path);
	}

	/**
	 * @readable Форма логина
	 * @return \lib\Item\WebItem
	 */
	public static function logoutForm()
	{
		$path = "//div[contains(@class, 'bx-system-auth-form')]/form[@action='/']";
		return self::webElementByXpath($path);
	}
} 