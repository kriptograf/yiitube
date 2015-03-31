<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->title), array('/news/news/view', 'id'=>$data->id_news)); ?>
	<br />

	<span class="date"><?php echo date('d.m.Y',$data->UpdatedDate); ?></span>
	<br />

	<?php echo Common::crop(strip_tags($data->content), 150); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('IsFeatured')); ?>:</b>
	<?php echo CHtml::encode($data->IsFeatured); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->UpdatedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Views')); ?>:</b>
	<?php echo CHtml::encode($data->Views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Useful')); ?>:</b>
	<?php echo CHtml::encode($data->Useful); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Unuseful')); ?>:</b>
	<?php echo CHtml::encode($data->Unuseful); ?>
	<br />

	*/ ?>

</div>