<?php

use lib\BasicItem;

class TO_General_Button
	extends BasicItem
{
	public static function login()
	{
		return self::webElementByXpath("//input[@name='Login']");
	}

	public static function logout()
	{
		return self::webElementByXpath("//form//table//tbody//tr//td//input[@name='logout_butt']");
	}
} 