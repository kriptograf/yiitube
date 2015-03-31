<?php

class SearchController extends Controller
{
	public function actionIndex()
	{
            //Защищаемся от xss
            $query = CHtml::encode($_POST['query']);
            
            if(empty($query) ||  mb_strlen($query,'UTF-8')<4)
            {
                $this->render('empty_index');
            }
            else
            {
                $criteria = new CDbCriteria();
                $criteria->addSearchCondition('title', $query);
                $criteria->addSearchCondition('text', $query, true, 'OR');

                $dataProvider = new CActiveDataProvider('Search', array(
                    'criteria'=>$criteria,
                ));

                $this->render('index', array(
                    'dataProvider'=>$dataProvider,
                    'query'=>$query,
                ));
            }
            
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