<?php
/* @var $this SearchController */

//$this->breadcrumbs=array(
//	'Search',
//);
?>
<h1>Результаты поиска по запросу: <?php echo $query;?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'emptyText'=>'По вашему запросу ничего не найдено. Попробуйте изменить поисковый запрос.',
)); ?>

