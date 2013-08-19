<?php
namespace lib\Helper;


class JSErrorHelper
{
	public static function filterErrors($errors)
	{
		$result = array();
		foreach($errors as $error) {
			if($error["level"] == "SEVERE")
				$result[] = $error;
		}
		
		return $result;
	}
} 