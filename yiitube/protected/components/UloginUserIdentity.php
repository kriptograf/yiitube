<?php

class UloginUserIdentity implements IUserIdentity
{

    private $id;
    private $name;
    public $full_name;
    private $isAuthenticated = false;
    private $states = array();

    public function __construct()
    {
    }

    public function authenticate($uloginModel = null)
    {

        $criteria = new CDbCriteria;
        $criteria->condition = 'identity=:identity AND network=:network';
        $criteria->params = array(
            ':identity' => $uloginModel->identity
        , ':network' => $uloginModel->network
        );
        $user = User::model()->find($criteria);

        if (null !== $user) 
        {
            //Если аккаунт соцсети прикреплен к основному аккаунту
            //Заполняем поля и аутентифицируем пользователя
            $this->id = $user->id;
            $this->name = $user->username;
            Yii::app()->user->fullname = $user->full_name;
        }
        else
        {
            /**
             * Возможна ситуация, что пользователь регистрировался через
             * стандартную форму регистрации и у него еще нет идентификатора соцсети
             */
            $user = User::model()->findByAttributes(array('email'=>$uloginModel->email));
            if(null !== $user)
            {
                $user->identity = $uloginModel->identity;
                $user->network = $uloginModel->network;
                $user->full_name = $uloginModel->full_name;
                if($user->save())
                {
                    $this->id = $user->id;
                    $this->name = $user->username;
                    Yii::app()->user->fullname = $user->full_name;
                }       
            }
            else
            {
                //Регистрируем нового юзера через соцсеть
                $user = new User();

                $password = substr(md5(microtime()), 0, 8);
                $user->password = md5($password);
                $user->activkey = md5(microtime().$password);
                $user->username = $uloginModel->email;    
                $user->identity = $uloginModel->identity;
                $user->network = $uloginModel->network;
                $user->email = $uloginModel->email;
                $user->full_name = $uloginModel->full_name;
                $user->superuser = 0;
                $user->state=1;

                if($user->save())
                {

                    /**
                     * После успешного создания юзера и создания его профиля
                     * Отправляем ему письмо на почту с учетными данными
                     */
                    mail(
                        $user->email,
                        "Вам создан аккаунт на сайте ".Yii::app()->name,
                        "Вы можете входить через свой аккаунт $user->network\n\r"
                            ." Или через форму входа на сайте используя\n\r"
                            ." Имя пользователя: $user->email\n\r"
                            ." Пароль: $password"
                    );
                }
                else
                {
                    return FALSE;
                }
                $this->id = $user->id;
                $this->name = $user->username;
                Yii::app()->user->fullname = $user->full_name;
            }        
        }
        $this->isAuthenticated = true;
        return true;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getFullname()
    {
        return $this->fullname;
    }

    public function getIsAuthenticated()
    {
        return $this->isAuthenticated;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPersistentStates()
    {
        return $this->states;
    }
}