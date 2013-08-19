<?php
namespace lib\Item;

use lib\BaseTestCase;

abstract class AssertationItem
	extends BaseItem
{

	/**
	 * @param string $text
	 * @param string $message
	 * @param bool $isCaseSensitive
	 */
	public function assertTextContain($text, $message = "", $isCaseSensitive = false)
	{
		BaseTestCase::assertContains($text, $this->text(), $message, $isCaseSensitive);
	}

	/**
	 * @param string $text
	 * @param string $message
	 * @param bool $isCaseSensitive
	 */
	public function assertNotTextContain($text, $message = "", $isCaseSensitive = false)
	{
		BaseTestCase::assertNotContains($text, $this->text(), $message, $isCaseSensitive);
	}

	/**
	 * @param string $pattern
	 * @param string $message
	 */
	public function assertTextRegExp($pattern, $message = "")
	{
		BaseTestCase::assertRegExp($pattern, $this->text(), $message);
	}

	/**
	 * @param string $htmlCode
	 * @param string $message
	 * @param bool $isCaseSensitive
	 */
	public function assertHtmlContain($htmlCode, $message = "", $isCaseSensitive = false)
	{
		BaseTestCase::assertContains($htmlCode, $this->innerHtml(), $message, $isCaseSensitive);
	}

	/**
	 * @param string $htmlCode
	 * @param string $message
	 * @param bool $isCaseSensitive
	 */
	public function assertNotHtmlContain($htmlCode, $message = "", $isCaseSensitive = false)
	{
		BaseTestCase::assertNotContains($htmlCode, $this->innerHtml(), $message, $isCaseSensitive);
	}

	/**
	 * @param string $pattern
	 * @param string $message
	 */
	public function assertHtmlRegExp($pattern, $message = "")
	{
		BaseTestCase::assertRegExp($pattern, $this->innerHtml(), $message);
	}

	/**
	 * @param string $value
	 * @param string $message
	 * @param bool $isCaseSensitive
	 */
	public function assertValueContain($value, $message = "", $isCaseSensitive = false)
	{
		BaseTestCase::assertContains($value, $this->value(), $message, $isCaseSensitive);
	}

	/**
	 * @param string $value
	 * @param string $message
	 * @param bool $isCaseSensitive
	 */
	public function assertNotValueContain($value, $message = "", $isCaseSensitive = false)
	{
		BaseTestCase::assertNotContains($value, $this->value(), $message, $isCaseSensitive);
	}

	/**
	 * @param string $pattern
	 * @param string $message
	 */
	public function assertValueRegExp($pattern, $message = "")
	{
		BaseTestCase::assertRegExp($pattern, $this->value(), $message);
	}
}