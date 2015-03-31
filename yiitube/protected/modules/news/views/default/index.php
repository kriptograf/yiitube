<?php
/* @var $this DefaultController */

//$this->breadcrumbs=array(
//	$this->module->id,
//);
?>

<h1>Новости</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'summaryText' => 'Новости: {start}-{end} из {count}',
)); ?>