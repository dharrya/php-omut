<?php
namespace lib;

use lib\Helper\DocParser;
use lib\Item\WebItem;

/**
 * Class BaseRepoItem
 * @package lib
 *
 * @method static \lib\Item\WebItem webElementByXpath($path, $logName = "")
 * @method static \lib\Item\WebItem webElementByClassName($className, $logName = "")
 * @method static \lib\Item\WebItem webElementByCssSelector($selector, $logName = "")
 * @method static \lib\Item\WebItem webElementById($id, $logName = "")
 * @method static \lib\Item\WebItem webElementByLinkText($text, $logName = "")
 * @method static \lib\Item\WebItem webElementByPartialLinkText($text, $logName = "")
 * @method static \lib\Item\WebItem webElementByName($name, $logName = "")
 * @method static \lib\Item\WebItem webElementByTag($tag, $logName = "")
 */
class BaseRepoItem
{
	public static function __callStatic($selector, $arguments)
	{
		if (strpos($selector, "webElement") !== 0)
			throw new \BadMethodCallException("Method '{$selector}' not implemented in RepoItem");

		if (!isset($arguments[1]) || !$arguments[1])
			$arguments[1] = self::getCallerLogName();

		list($value, $logName) = $arguments;
		$selector = substr($selector, strlen("webElement"));
		return WebItem::$selector($value, $logName);
	}

	private static function getCallerLogName($depth = 3)
	{
		$callStack = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS, $depth + 1);
		$caller = array_pop($callStack);
		return DocParser::getMethodTagValue(
			$caller["class"],
			$caller["function"],
			"logname"
		);
	}
}