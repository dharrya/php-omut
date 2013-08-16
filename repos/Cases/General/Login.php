<?php

class Cases_General_Login
	extends BasicItem
{

	public static function toBus($login, $password)
	{
		TO_General_TextBox::userLogin()->value($login);
		TO_General_TextBox::userPassword()->value($password);
		TO_General_Button::login()->click();
	}

	public static function logoutBus()
	{
		TO_General_Button::logout()->click();
	}

} 