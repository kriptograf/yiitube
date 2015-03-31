<?php
$this->breadcrumbs=array(
	'Комментарии'=>array('index'),
	'Изменить комментарий #'.$model->id,
);
?>

<h1>Изменить комментарий #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>