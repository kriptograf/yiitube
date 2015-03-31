<?php

/**
 * @property string $title
 * @property string $text
 * @property string $url
 */
class Search extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'view_search';
    }
}
