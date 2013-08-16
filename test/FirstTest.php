<?php

use lib\BaseTestCase;

class WebTest
	extends BaseTestCase
{

	protected $baseUrl = "http://bus-win.my/";
	protected $login = "admin";
//	protected $password = "_incorrect_pass_";
	protected $password = "rrrrrr";

	public function testLoginAndLogOut()
	{
		$this->url("index.php");

		if(!TO_Module_Main::loginForm()->exists())
			Cases_General_Login::logoutBus();

		Cases_General_Login::toBus($this->login, $this->password);
		$this->assertFalse(TO_Module_Main::loginForm()->exists(), 'Login Failed :`(');

		Cases_General_Login::logoutBus();
		$this->assertTrue(TO_Module_Main::loginForm()->exists(), 'Logout Failed :`(');
	}
}