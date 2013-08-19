<?php
namespace lib\Item;
use lib\Exception\Item\ItemNotFound;

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
 * @method string value($newValue = null) Get or set value of form elements. If the element already has a value, the set one will be appended to it.
 * @method string text() Get content of ordinary elements
 *
 */
abstract class BaseItem
{
	/** @var \PHPUnit_Extensions_Selenium2TestCase_Element $element */
	protected $element = null;
	protected $isExist = true;

	public function __construct(\PHPUnit_Extensions_Selenium2TestCase_Element $element)
	{
		$this->element = $element;
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
		if (!$this->isExist)
			throw new ItemNotFound('Trying use a non-existent object');

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
} 