<?php
/* @var $this VideosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Videos',
);

$this->menu=array(
	array('label'=>'Create Videos', 'url'=>array('create')),
	array('label'=>'Manage Videos', 'url'=>array('admin')),
);
?>

<h1>Videos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
