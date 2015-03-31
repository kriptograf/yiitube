<?php

class LoginController extends Controller
{
    public $defaultAction = 'login';
    
    public function actionLogin()
    {
        $model = new LoginForm();

        if(isset($_POST['LoginForm']))
        {
            $model->setAttributes($_POST['LoginForm']);
            
           

            if ($model->validate())
            {
                Yii::app()->user->setFlash('success','Вы успешно авторизованы.');
                $this->redirect('/');
            }
            else
            {
                Yii::app()->user->setFlash('success',  'Не верный логин или пароль.');
                $this->redirect('/');
            }

                
        }
        $this->redirect('/');
        //$this->render('login',array('model'=>$model));
    }
}
