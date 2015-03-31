<?php
class LoginController extends AdminController
{
    public $defaultAction = 'login';
    
    public function actionLogin()
    {
        $model = new AdminLoginForm();

        if(isset($_POST['AdminLoginForm']))
        {
            $model->setAttributes($_POST['AdminLoginForm']);

            if ($model->validate() && $model->login())
            {
                $this->redirect('/admin');
            }
                
        }
        $this->render('login',array('model'=>$model));
    }
}
