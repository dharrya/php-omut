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

	/**
	 * @param string $className
	 * @return \lib\Item\WebItem
	 */
	protected static function webElementByClassName($className)
	{
		return \lib\Item\WebItem::byClassName($className);
	}

	/**
	 * @param string $selector
	 * @return \lib\Item\WebItem
	 */
	protected static function webElementByCssSelector($selector)
	{
		return \lib\Item\WebItem::byCssSelector($selector);
	}

	/**
	 * @param string $id
	 * @return \lib\Item\WebItem
	 */
	protected static function webElementById($id)
	{
		return \lib\Item\WebItem::byId($id);
	}

	/**
	 * @param string $text
	 * @return \lib\Item\WebItem
	 */
	protected static function webElementByLinkText($text)
	{
		return \lib\Item\WebItem::byLinkText($text);
	}

	/**
	 * @param string $text
	 * @return \lib\Item\WebItem
	 */
	protected static function webElementByPartialLinkText($text)
	{
		return \lib\Item\WebItem::byPartialLinkText($text);
	}

	/**
	 * @param string $name
	 * @return \lib\Item\WebItem
	 */
	protected static function webElementByName($name)
	{
		return \lib\Item\WebItem::byName($name);
	}

	/**
	 * @param string $tag
	 * @return \lib\Item\WebItem
	 */
	protected static function webElementByTag($tag)
	{
		return \lib\Item\WebItem::byTag($tag);
	}
}