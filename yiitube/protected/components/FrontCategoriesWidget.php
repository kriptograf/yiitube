<?php

class FrontCategoriesWidget extends CWidget
{
    public function init() {
        parent::init();
    }
    public function run() {
        parent::run();
        $this->renderContent();
    }
    public function renderContent()
    {
        $cat = Categories::model()->findAll();
        $this->render('frontCategories', array('categories'=>$cat));
    }
}
