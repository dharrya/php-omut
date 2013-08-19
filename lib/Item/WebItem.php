<?php
namespace lib\Item;
use lib\Runtime;

/**
 * Class WebItem
 *
 * @package lib
 * @method static \lib\Item\WebItem byClassName($value)
 * @method static \lib\Item\WebItem byCssSelector($value)
 * @method static \lib\Item\WebItem byId($value)
 * @method static \lib\Item\WebItem byLinkText($value)
 * @method static \lib\Item\WebItem byPartialLinkText($value)
 * @method static \lib\Item\WebItem byName($value)
 * @method static \lib\Item\WebItem byTag($value)
 * @method static \lib\Item\WebItem byXPath($value)
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
			$element = call_user_func_array(
				array(Runtime::session(), $accessor), $arguments
			);
			$result = new static($element);
		} catch (\PHPUnit_Extensions_Selenium2TestCase_WebDriverException $e) {
			$result = new NullWebItem();
		}

		return $result;
	}

} 