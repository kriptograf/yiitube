<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#news-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Новости - управление</h1>

<?php
$this->menu=array(
    array('label'=>'Добавить', 'url'=>array('create'), 'linkOptions'=>array('class'=>'add')),
);
?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news-grid',
        'cssFile'=>'',
        'summaryText'=>'',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id_news',
                'title',
                'alias',
                array(
                    'name'=>'content',
                    'value'=>  'Common::crop(strip_tags($data->content), 150)',
                ),
                'UpdatedDate',
                'IsFeatured',
                'status',
		/*
		'CreatedDate',
		'user_id',
		'Views',
		'Useful',
		'Unuseful',
		*/
                 array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
