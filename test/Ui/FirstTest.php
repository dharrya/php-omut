<?php
use lib\BaseTestCase;

class FirstTest
	extends BaseTestCase
{
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
