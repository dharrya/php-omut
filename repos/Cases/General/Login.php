<?php

use lib\BasicItem;

class Cases_General_Login
	extends BasicItem
{

	/**
	 * Login to BUS, your K.O.
	 *
	 * @param string $login
	 * @param string $password
	 */
	public static function toBus($login, $password)
	{
		TO_General_TextBox::userLogin()->value($login);
		TO_General_TextBox::userPassword()->value($password);
		TO_General_Button::login()->click();
	}

	/**
	 * Logout from BUS, your K.O.
	 */
	public static function logoutBus()
	{
		TO_General_Button::logout()->click();
	}

} 