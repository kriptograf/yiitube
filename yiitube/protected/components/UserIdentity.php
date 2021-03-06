<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    private $name;
    //private $fullname;

    const ERROR_EMAIL_INVALID=3;
    const ERROR_STATUS_NOTACTIV=4;
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
            
            if (strpos($this->username,"@")) 
            {
		$users=User::model()->findByAttributes(array('email'=>$this->username));
            } 
            else 
            {
		$users=User::model()->findByAttributes(array('username'=>$this->username));
                
            }
            if($users === null)
            {
                if (strpos($this->username,"@")) 
                {
                        $this->errorCode=self::ERROR_EMAIL_INVALID;
                }
                else {
                        $this->errorCode=self::ERROR_USERNAME_INVALID;
                }
            }	
            else if(md5($this->password)!==$users->password)
            {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }		
            else if($users->state==0)
            {
                $this->errorCode = self::ERROR_STATUS_NOTACTIV;
            }		
            else 
            { 
                    $this->_id = $users->id;
                    $this->name = $users->username;
                    Yii::app()->user->fullname = $users->full_name;
                    $this->errorCode = self::ERROR_NONE;
            }
            return !$this->errorCode;
	}
        
        /**
        * @return integer the ID of the user record
        */
	public function getId()
	{
		return $this->_id;
	}
        
//        public function getFullname()
//        {
//            return $this->fullname;
//        }
}