<?php

class RegistrationController extends Controller
{
    public $defaultAction = 'register';
    
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'foreColor' => 0x6e696a,
            ),
        );
    }
    
    
    public function actionRegister()
    {
        $model = new User;
        $model->setScenario('registration');

        if(isset($_POST['User']))
        {
            $model->setAttributes($_POST['User']);
            
            //echo CVarDumper::dump($model->attributes,10,true);exit;
            $sourcePassword = $model->password;
            
            //генерация активационного кода
            $model->activkey = md5(microtime());
            $model->password = md5($model->password);
            $model->verifyPassword = md5($model->verifyPassword);
            $model->superuser = 0;
            $model->state = 1;

            if($model->save())
            {
                
                /*
                 * Ссылка для подтверждения регистрации
                 */
                //$link_confirm  = Yii::app()->createAbsoluteUrl('users/confirm', array('email'=>$model->email,'code'=>$model->activkey));
                
                /*
                 * Вытаскиваем тему письма из шаблона
                 */
                //$subject_confirm	= 'Вы зарегистрировались на сайте Клик ТВ';
                
                
//                $message = $this->renderPartial('/email/success_register', array(
//                    'login'=>$model->login,
//                    'password'=>$sourcePassword,
//                    'link'=>$link_confirm,
//                    ),TRUE,FALSE);
//
//                Yii::app()->mailer->From = 'moskvinvitaliy@gmail.com';
//                Yii::app()->mailer->FromName = 'Администрация сайта Клик ТВ';
//                Yii::app()->mailer->AddReplyTo('foreach@mail.ru');
//                Yii::app()->mailer->CharSet = 'UTF-8';
//                Yii::app()->mailer->Subject = $subject_confirm;//$subject_jobseeker_confirm;
//                Yii::app()->mailer->IsHTML(true);
//                Yii::app()->mailer->Body = $message;
//                Yii::app()->mailer->AddAddress($model->email);
//                Yii::app()->mailer->Send();
//                Yii::app()->mailer->ClearAddresses();

                //Yii::app()->user->setFlash('success','Вы успешно зарегистрированы. На ваш адрес электронной почты выслано письмо с инструкциями по активации вашего аккаунта. Проверьте вашу электронную почту.');

                Yii::app()->user->setFlash('success','Вы успешно зарегистрированы. Межете войти используя логин и пароль. Или воспользоваться для входа своим аккаунтом в социальной сети.');                        

                $this->redirect(Yii::app()->homeUrl);
            }
                
        }

        $this->render('registration',array('model'=>$model));
    }
}
