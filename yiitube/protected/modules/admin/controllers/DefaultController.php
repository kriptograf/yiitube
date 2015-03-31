<?php

class DefaultController extends AdminController
{
        /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column1';
        
	public function actionIndex()
	{
		$this->render('index');
	}
}