<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebUser
 *
 * @author foreach
 */
class WebUser extends CWebUser {
    public $full_name;
    
    //to set globalunit
    public function setFullname($value)
    {
            Yii::app()->user->setState('fullname',$value);
    }

    //to get globalunit
    public function getFullname()
    {
           return Yii::app()->user->getState('fullname');
    }

}

