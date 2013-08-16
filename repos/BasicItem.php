<?php
use lib\Runtime;
use lib\WebItem;

class BasicItem
{
	/**
	 * @param string $path
	 * @return \lib\WebItem
	 */
	protected static function webElementByXpath($path)
	{
		return \lib\WebItem::byXPath($path);
	}

}