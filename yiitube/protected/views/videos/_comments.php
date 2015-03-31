<?php foreach($comments as $comment): ?>
<div class="comment" id="c<?php echo $comment->id; ?>">

	

	<div class="author-comment">
		<?php echo CHtml::link("#{$comment->id}", $comment->getUrl($post), array(
				'class'=>'cid',
				'title'=>'Прямая ссылка на комментарий',
			)); 
		?>
		<?php echo $comment->authorLink; ?> пишет:
		
	</div>

	<div class="time">
		<?php echo date('d.m.Y h:i',$comment->create_time); ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($comment->content)); ?>
	</div>

</div><!-- comment -->
<?php endforeach; ?>