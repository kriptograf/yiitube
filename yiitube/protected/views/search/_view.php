<?php
/* @var $this PageController */
/* @var $data Pages */
?>

<div class="view">


	<?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?> <span class="search-type"><?php echo $data->type;?></span>
	<br />


	<?php echo Common::crop(strip_tags($data->text), 150); ?>
	<br />

</div>