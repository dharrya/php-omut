<?php
namespace lib\Item;
use lib\Runtime;

/**
 * Class WebItem
 *
 * @package lib
 * @method static \lib\Item\WebItem byClassName($className, $readableName = "")
 * @method static \lib\Item\WebItem byCssSelector($selector, $readableName = "")
 * @method static \lib\Item\WebItem byId($id, $readableName = "")
 * @method static \lib\Item\WebItem byLinkText($text, $readableName = "")
 * @method static \lib\Item\WebItem byPartialLinkText($text, $readableName = "")
 * @method static \lib\Item\WebItem byName($name, $readableName = "")
 * @method static \lib\Item\WebItem byTag($tag, $readableName = "")
 * @method static \lib\Item\WebItem byXPath($path, $readableName = "")
 */
class WebItem
	extends AssertationItem
{

	/**
	 * Initialize item by Selenium Element Accessor
	 *
	 * @param string $accessor
	 * @param mixed $arguments
	 * @return static
	 */
	public static function __callStatic($accessor, $arguments)
	{
		try {
			if(!isset($arguments[1]))
				$arguments[1] = "";
			list($value, $readableName) = $arguments;

			$element = Runtime::session()->$accessor($value);
			$result = new static($element, $readableName);
		} catch (\PHPUnit_Extensions_Selenium2TestCase_WebDriverException $e) {
			$result = new NullWebItem();
		}

		return $result;
	}

} 