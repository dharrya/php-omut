<?php
namespace lib\Helper;


class DocParser
{
	/**
	 * @param string $class
	 * @param string $method
	 * @return string
	 */
	public static function getMethodBlock($class, $method)
	{
		return (new \ReflectionMethod($class, $method))->getDocComment();
	}

	/**
	 * @param string $class
	 * @return string
	 */
	public static function getClassBlock($class)
	{
		return (new \ReflectionClass($class))->getDocComment();
	}

	/**
	 * @param string $class
	 * @param string $method
	 * @param string $tag
	 * @return string
	 */
	public static function getMethodTagValue($class, $method, $tag)
	{
		$docText = self::getMethodBlock($class, $method);
		return self::getTagValue($docText, $tag);
	}

	/**
	 * @param string $class
	 * @param string $tag
	 * @return string
	 */
	public static function getClassTagValue($class, $tag)
	{
		$docText = self::getClassBlock($class);
		return self::getTagValue($docText, $tag);
	}

	/**
	 * @param $text
	 * @param string $tag
	 * @return string
	 */
	public static function getTagValue($text, $tag)
	{
		$result = "";

		if (empty($text))
			return $result;

		$matches = array();
		$tag = preg_quote($tag, "#");
		preg_match("#@{$tag} (.*)(\\r\\n|\\r|\\n)#iU", $text, $matches);

		if (!empty($matches[1]))
			$result = trim($matches[1]);

		return $result;
	}
} 