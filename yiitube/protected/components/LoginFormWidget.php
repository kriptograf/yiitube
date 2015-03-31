<?php

class LoginFormWidget extends CWidget
{
    public function init() {
        parent::init();
    }
    public function run() {
        $this->renderContent();
        parent::run();
    }
    public function renderContent()
    {
        $user = new LoginForm();
        $this->render('login', array('model'=>$user));
    }
}
