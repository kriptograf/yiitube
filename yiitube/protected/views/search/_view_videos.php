<?php
/* @var $this PageController */
/* @var $data Pages */
?>

<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->name), array('/videos/view', 'id'=>$data->id)); ?>
	<br />

	<?php echo Common::crop(strip_tags($data->text),150); ?>
	<br />

</div>