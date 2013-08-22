<?php

use lib\BaseRepoItem;

class TO_General_Button
	extends BaseRepoItem
{

	/**
	 * @logname Батон логина
	 * @return \lib\Item\WebItem
	 */
	public static function login()
	{
		return self::webElementByXpath("//input[@name='Login']");
	}


	/**
	 * @logname Батон логаута
	 * @return \lib\Item\WebItem
	 */
	public static function logout()
	{
		return self::webElementByXpath("//form//table//tbody//tr//td//input[@name='logout_butt']");
	}
} 