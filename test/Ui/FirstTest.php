<?php
use lib\BaseTestCase;

class FirstTest
	extends BaseTestCase
{

	/**
	 *
	 * @browser chrome
	 */
	public function testAdminLoginInDB()
	{
		$this->url("/");
		$query = $this->db()->query("SELECT LOGIN FROM b_user;");
		$logins = $query->fetchAll();
		$this->assertContains(array("LOGIN" => "admin"), $logins);
	}

	/**
	 *
	 * @browser chrome, firefox
	 */
	public function testTitle()
	{
		$this->url("/");
		$this->assertContains("Демонстрационная", $this->title());
	}
}
