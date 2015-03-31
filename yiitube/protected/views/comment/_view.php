<div class="comment" id="c<?php echo $data->id; ?>">

	<?php echo CHtml::link("#{$data->id}", $data->url, array(
		'class'=>'cid',
		'title'=>'Прямая ссылка на комментарий',
	)); ?>

	<div class="author">
		<?php echo $data->authorLink; ?> пишет в
		<?php echo CHtml::link(CHtml::encode($data->post->title), $data->post->url); ?>
	</div>

	<div class="time">
		<?php if($data->status==Comment::STATUS_PENDING): ?>
			<span class="pending">Ожидает одобрения</span> |
			<?php echo CHtml::linkButton('Одобрить', array(
				'submit'=>array('comment/approve','id'=>$data->id),
			)); ?> |
		<?php endif; ?>
		<?php echo CHtml::link('Обновить',array('comment/update','id'=>$data->id)); ?> |
		<?php echo CHtml::linkButton('Удалить', array(
			'submit'=>array('comment/delete','id'=>$data->id),
			'confirm'=>"Вы точно хотите удалить комментарий #{$data->id}?",
		)); ?> |
		<?php echo date('d.m.Y',$data->create_time); ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($data->content)); ?>
	</div>

</div><!-- comment -->