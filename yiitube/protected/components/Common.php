<?php

class Common extends CComponent
{
    /**
     * Обрезка названия акции на главной.
     * @param $string
     * @param $limit
     * @return string
     */
    public static function crop($string, $limit)
    {

        if (strlen($string) >= $limit )
        {
            $substring_limited = substr($string,0, $limit);
            return substr($substring_limited, 0, strrpos($substring_limited, ' ' )).' ...';
        }
        else
        {
            //Если количество символов строки меньше чем задано,
            //то просто возращаем оригинал
            return $string;
        }
    }
}
