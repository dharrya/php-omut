<?php

use lib\BaseRepoItem;

class TO_General_Button
	extends BaseRepoItem
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