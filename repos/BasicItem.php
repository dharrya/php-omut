<?php
use lib\Runtime;
use lib\WebItem;

class BasicItem
{
	protected static function webElementByXpath($path)
	{
		return WebItem::byXPath($path);
	}

}