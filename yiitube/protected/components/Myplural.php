<?php
class Myplural
{
	public static function plural($numberof, $value, $suffix)
	{
	    $keys = array(2, 0, 1, 1, 1, 2);
	    $mod = $numberof % 100;
	    $suffix_key = $mod > 4 && $mod < 20 ? 2 : $keys[min($mod%10, 5)];
	    
	    return $value . $suffix[$suffix_key];
	}
}