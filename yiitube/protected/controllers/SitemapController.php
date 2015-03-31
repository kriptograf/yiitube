<?php

class SitemapController extends Controller
{
	public function actionIndex()
	{
		$sitemap = new DSitemap();
                $sitemap->addModels(Videos::model()->findAll(), DSitemap::DAILY, 0.8);
                $sitemap->addModels(Pages::model()->findAll(), DSitemap::DAILY, 0.5);
                $sitemap->addModels(Categories::model()->findAll(), DSitemap::WEEKLY, 0.2);

                header("Content-type: text/xml");
                echo $sitemap->render();
                Yii::app()->end();
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}