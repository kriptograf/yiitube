<?php

class FeaturedVideoWidget extends CWidget
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
        $videos = Videos::model()->findAll('featured=1');
        $this->render('featuredVideo', array('videos'=>$videos));
    }
}
