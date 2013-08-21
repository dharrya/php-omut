<?php
namespace lib;

use lib\Helper\DocParser;
use lib\Item\WebItem;

/**
 * Class BaseRepoItem
 * @package lib
 *
 * @method static \lib\Item\WebItem webElementByXpath($path, $readableName = "")
 * @method static \lib\Item\WebItem webElementByClassName($className, $readableName = "")
 * @method static \lib\Item\WebItem webElementByCssSelector($selector, $readableName = "")
 * @method static \lib\Item\WebItem webElementById($id, $readableName = "")
 * @method static \lib\Item\WebItem webElementByLinkText($text, $readableName = "")
 * @method static \lib\Item\WebItem webElementByPartialLinkText($text, $readableName = "")
 * @method static \lib\Item\WebItem webElementByName($name, $readableName = "")
 * @method static \lib\Item\WebItem webElementByTag($tag, $readableName = "")
 */
class BaseRepoItem
{
	public static function __callStatic($selector, $arguments)
	{
		if (strpos($selector, "webElement") !== 0)
			throw new \BadMethodCallException("Method '{$selector}' not implemented in RepoItem");

		if (!isset($arguments[1]) || !$arguments[1])
			$arguments[1] = self::getCallerReadableName();

		list($value, $readableName) = $arguments;
		$selector = substr($selector, strlen("webElement"));
		return WebItem::$selector($value, $readableName);
	}

	private static function getCallerReadableName($depth = 3)
	{
		$callStack = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS, $depth + 1);
		$caller = array_pop($callStack);
		return DocParser::getMethodTagValue(
			$caller["class"],
			$caller["function"],
			"readable"
		);
	}
}