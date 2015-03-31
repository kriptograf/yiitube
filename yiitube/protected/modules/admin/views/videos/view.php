<?php
/* @var $this VideosController */
/* @var $model Videos */

$this->breadcrumbs=array(
	'Videos'=>array('index'),
	$category['name']=>array('categories/view&id=1'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Videos', 'url'=>array('index')),
	array('label'=>'Create Videos', 'url'=>array('create')),
	array('label'=>'Update Videos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Videos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Videos', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->name; ?></h1>

<?php
$this->widget('application.extensions.videojs.EVideoJS', array(
    'options' => array(
        // Уникальный идентификатор, генерируется автоматически по умолчанию, полезный для JQuery интеграции
        'id' => false,
        // Видео и постер ширину в пикселях
        'width' => 640,
        // Видео и постер ширину в пикселях
        'height' => 390,
        // Poster image absolute URL
        'poster' => '/video-js/test-poster.png',
        // Absolute URL of the video in MP4 format
        'video_mp4' => '/files/videos/'.$model->video,
        // Absolute URL of the video in OGV format
        'video_ogv' => '/files/videos/'.$model->video,
        // Absolute URL of the video in WebM format
        'video_webm' => '/files/videos/'.$model->video,
        // Использовать Flash резервный плеер ?
        'flash_fallback' => true,
        // Адрес Пользовательский Flash плеер для использования в качестве резервного
        'flash_player' => 'http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf',
        // Show controls ?
        'controls' => true,
        // Предварительная загрузка видео контента ?
        'preload' => true,
        // Автостарт воспроизведения ?
        'autoplay' => false,
        // Показать VideoJS ссылка поддержки ?
        'support' => false,
        // Show video download links ?
        'download' => false,
    ),
));
?>
<br>
<br>
<p>
	Понравилось: <?=$likes;?> пользователям <br>
	Не понравилось: <?=$dislikes;?> пользователям
</p>

<?php if (!empty(Yii::app()->user->id)) : ?>
	<p id="dislike-block" style="color: #ff0000; font-weight: bold; <?=($mind == '-1')?'':'display:none;'; ?>">
		Вы уже проголосовали против этого видео
	</p>
	<p id="like-block" style="color: #00ff00; font-weight: bold; <?=($mind == '1')?'':'display:none;'; ?>">
		Вы уже проголосовали за это видео
	</p>
	<p id="like-buttons-block" <?=($mind != '1' && $mind != '-1')?'':'style="display:none;"';?>>
		<button id="like">Нравится</button>
		<button id="dislike">Не нравится</button>
	</p>
<?php endif; ?>

<p><?php echo nl2br($model->description); ?></p>

<script type="text/javascript">
	$('button#like').click(function(){
		$.post(
			'index.php?r=likes/create',
			{
				'Likes[user_id]': '<?=Yii::app()->user->id;?>',
				'Likes[video_id]': '<?=$model->id;?>',
				'Likes[mind]': '1'
			},
			function(data){
				$('p#like-buttons-block').hide();
				$('p#like-block').show();
			}
		);
	});

	$('button#dislike').click(function(){
		$.post(
			'index.php?r=likes/create',
			{
				'Likes[user_id]': '<?=Yii::app()->user->id;?>',
				'Likes[video_id]': '<?=$model->id;?>',
				'Likes[mind]': '-1'
			},
			function(){
				$('p#like-buttons-block').hide();
				$('p#dislike-block').show();
			}
		);
	});
</script>
