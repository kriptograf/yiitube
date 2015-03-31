<?php

class VideosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$likes = Likes::model()->likesForVideo($model->id, '1');
		$dislikes = Likes::model()->likesForVideo($model->id, '-1');
		$mind = Likes::model()->usersOpinion($model->id, Yii::app()->user->id);
                
                $comment = $this->newComment($model);
                
                $views = $model->views+1;
                $model->updateByPk($id, array('views'=>$views));

		$this->render('view',array(
			'model'=>$model,
			'category'=> Yii::app()->db->createCommand()
				->select('name')
				->from('categories')
				->where('id='.$model->category_id)
				->queryRow(),
			'likes'=>$likes,
			'dislikes'=>$dislikes,
			'mind'=>$mind,
                        'comment'=>$comment,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Videos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Videos']))
		{
			$model->attributes=$_POST['Videos'];
			$model->video=CUploadedFile::getInstance($model,'video');
			if($model->save()) {
				$model->video->saveAs('files/videos/'.$model->video->getName());
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$categories_tmp = Yii::app()->db->createCommand()
			->select('id, name')
			->from('categories')
			->queryAll();
		// preparing to insert in form->dropdown()
		$categories = array();
		foreach($categories_tmp as $key=>$value) {
			$categories[$value['id']] = $value['name'];
		}

		$this->render('create',array(
			'model'=>$model,
			'categories'=>$categories,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Videos']))
		{
			$model->attributes=$_POST['Videos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$categories_tmp = Yii::app()->db->createCommand()
			->select('id, name')
			->from('categories')
			->queryAll();
		// preparing to insert in form->dropdown()
		$categories = array();
		foreach($categories_tmp as $key=>$value) {
			$categories[$value['id']] = $value['name'];
		}

		$this->render('create',array(
			'model'=>$model,
			'categories'=>$categories,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Videos');

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Videos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Videos']))
			$model->attributes=$_GET['Videos'];

		$categories_tmp = Yii::app()->db->createCommand()
			->select('id, name')
			->from('categories')
			->queryAll();
		// preparing to insert in form->dropdown()
		$categories = array();
		foreach($categories_tmp as $key=>$value) {
			$categories[$value['id']] = $value['name'];
		}

		$this->render('admin',array(
			'model'=>$model,
			'categories'=>$categories,
		));
	}
        
        /**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Post the post that the new comment belongs to
	 * @return Comment the comment instance
	 */
	protected function newComment($post)
	{
		$comment=new Comment;
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($post->addComment($comment))
			{
				/**
				 * Отправляем уведомление о новом комментарии
				 */
				/* Для отправки HTML-почты вы можете установить шапку Content-type. */
				$headers= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=utf-8\r\n";
				$to = 'foreach@mail.ru';
				$subject = 'На сайт Клик ТВ добавлен комментарий';
				$message = 'На сайт Клик ТВ добавлен новый комментарий. <br>Текст комментария:<br>"'.$_POST['Comment']['content'].'"';
				mail($to,$headers,$message,$headers);
				
				if($comment->status==Comment::STATUS_PENDING)
					Yii::app()->user->setFlash('commentSubmitted','Спасибо за ваш комментарий. Он будет опубликован после одобрения модератором.');
				$this->refresh();
			}
		}
		return $comment;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Videos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Videos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Videos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='videos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
