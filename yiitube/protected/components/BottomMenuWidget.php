<?php

class BottomMenuWidget extends CWidget
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
        $model = Categories::model()->findAll('top=1');
        $this->render('bottomMenu',array('model'=>$model));
    }
}
