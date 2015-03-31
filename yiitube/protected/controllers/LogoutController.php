<?php

class LogoutController extends Controller
{
    public $defaultAction = 'logout';
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
    }
}
