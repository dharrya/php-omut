<?php
namespace lib\Item;
use lib\Exception\Item\ItemNotFound;
use lib\Logger;
use lib\Runtime;

/**
 * Class WebItem
 *
 * @package lib
 * @method int getId()
 * @method string name()
 * @method array toWebDriverObject()
 * @method string attribute($name) Retrieves an element's attribute
 * @method void clear() Empties the content of a form element.
 * @method void click() Clicks on element
 * @method string css($propertyName) Retrieves the value of a CSS property
 * @method bool displayed() Checks an element's visibility
 * @method bool enabled() Checks a form element's state
 * @method array location() Retrieves the element's position in the page: keys 'x' and 'y' in the returned array
 * @method bool selected() Checks the state of an option or other form element
 * @method array size() Retrieves the dimensions of the element: 'width' and 'height' of the returned array
 * @method void submit() Submits a form; can be called on its children
 * @method string text() Get content of ordinary elements
 *
 */
abstract class BaseItem
{
	/** @var \PHPUnit_Extensions_Selenium2TestCase_Element $element */
	protected $element = null;
	protected $isExist = true;
	protected $readableName = "";

	public function __construct(\PHPUnit_Extensions_Selenium2TestCase_Element $element, $readableName = "")
	{
		$this->element = $element;
		$this->readableName = $readableName;
	}

	/**
	 * @return \PHPUnit_Extensions_Selenium2TestCase_Element
	 */
	public function toSeleniumElement()
	{
		return $this->element;
	}

	/**
	 * Checks if the two elements are the same on the page
	 *
	 * @param WebItem $another
	 * @return bool
	 */
	public function equals(WebItem $another)
	{
		return $this->element->equals($another->toSeleniumElement());
	}

	/**
	 * Delegate method calls to the Selenium Element
	 *
	 * @param string $command
	 * @param array $arguments
	 * @throws \lib\Exception\Item\ItemNotFound
	 * @return mixed
	 */
	public function __call($command, $arguments)
	{
		if ($this->readableName) {
			Logger::addMessage(sprintf(
					"'%s' element call: %s(%s)",
					$this->readableName, $command, implode(", ", $arguments)
				)
			);
		}

		if (!$this->isExist) {
			throw new ItemNotFound('Trying use a non-existent object');
		}

		$result = call_user_func_array(
			array($this->element, $command), $arguments
		);

		return $result;
	}

	/**
	 * @return bool
	 */
	public function exists()
	{
		return $this->isExist;
	}

	/**
	 * @param bool $isExist
	 */
	public function setExist($isExist = true)
	{
		$this->isExist = $isExist;
	}

	/**
	 * Return innerHTML element attribute
	 *
	 * @return string
	 */
	public function innerHtml()
	{
		return $this->attribute('innerHTML');
	}

	/**
	 * Get or set value of form elements.
	 * By default if the element already has a value it will be overwritten.
	 *
	 * @param null|string $newValue
	 * @param bool $isClearBeforeSend
	 * @return mixed
	 */
	public function value($newValue = null, $isClearBeforeSend = true)
	{
		if ($newValue && $isClearBeforeSend)
			$this->clear();

		return $this->__call("value", array($newValue));
	}
} 