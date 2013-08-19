<?php
use lib\Runtime;
use lib\Item\WebItem;

class BasicItem
{
	/**
	 * @param string $path
	 * @return \lib\Item\WebItem
	 */
	protected static function webElementByXpath($path)
	{
		return \lib\Item\WebItem::byXPath($path);
	}

}