<?php
class NewsSliderWidget extends CWidget
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
        $criteria = new CDbCriteria();
        $criteria->compare('IsFeatured', 1);
        $criteria->compare('Useful', '>'.time());
        
        $news = News::model()->findAll($criteria);
        
        $this->render('slider', array('news'=>$news));
    }
}
