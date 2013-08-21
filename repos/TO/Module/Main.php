<?php

use lib\BaseRepoItem;

class TO_Module_Main
	extends BaseRepoItem
{

	public static function buttonCalendarDate($day)
	{
		$path = "//a[contains(@class, 'bx-calendar-cell') and not(contains(@class, 'bx-calendar-date-hidden')) and contains(text(), {$day})]";
		return self::webElementByXpath($path);
	}

	public static function loginForm()
	{
		$path = "//div[contains(@class, 'bx-system-auth-form')]/form[@action='/?login=yes']";
		return self::webElementByXpath($path);
	}

	public static function logoutForm()
	{
		$path = "//div[contains(@class, 'bx-system-auth-form')]/form[@action='/']";
		return self::webElementByXpath($path);
	}
} 