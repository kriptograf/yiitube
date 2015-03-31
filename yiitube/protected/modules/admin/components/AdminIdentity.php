<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity
{
    private $_id;
    private $name;
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
            $model = User::model()->find('username=:username OR email=:username AND superuser=:superuser',array(':username'=>$this->username,':superuser'=>1));

            if($model===null)
            {
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }			
            else if($model->password !== md5($this->password))
            {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }	
            else 
            {
                $this->errorCode=self::ERROR_NONE;
                $this->name = $model->username;
                //$this->setState('is_admin',$model->is_admin);
                //логин пользователя для правил ролевого доступа
                Yii::app()->user->fullname = $model->full_name;
                $this->_id = $model->id;
            }
            return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}