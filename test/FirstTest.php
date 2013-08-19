<?php

use lib\BaseTestCase;

class WebTest
	extends BaseTestCase
{
	public function testLoginAndLogOut()
	{
		$this->url("index.php");
		if(!TO_Module_Main::loginForm()->exists()) {
			$this->addMessage("Форма логина не найдена, логаутимся");
			Cases_General_Login::logoutBus();
		}
		$login = $this->conf()->site()->UserName;
		$password = $this->conf()->site()->Password;

		$this->addMessage(
			sprintf(
				"Пытаемся войти с логином '%s' и паролем '%s'",
				$login, $password
			)
		);

		Cases_General_Login::toBus($login, $password);
		$this->assertFalse(TO_Module_Main::loginForm()->exists(), "Login Failed :`(");

		TO_Module_Main::logoutForm()->assertTextContain("Мой профиль", "Link to user profile not found after login");

		Cases_General_Login::logoutBus();
		$this->assertTrue(TO_Module_Main::loginForm()->exists(), "Logout Failed :`(");

	}

	public function testAdminLoginInDB()
	{
		$query = $this->db()->query("SELECT LOGIN FROM b_user;");
		$logins = $query->fetchAll();
		$this->assertContains(array("LOGIN" => "admin"), $logins);
	}

	public function testTitle()
	{
		$this->url("/");
		$this->assertContains("Демонстрационная", $this->title());
	}
}
