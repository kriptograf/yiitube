<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="row">
    <div class="span9">
        <?php $this->widget('TopMenuWidget');?>
        <?php $data = $videos_data->getData(); ?>
        <?php for ($i=1; $i<=3; $i++): ?>
        <?php
                $this->widget('application.extensions.videojs.EVideoJS', array(
                    'options' => array(
                        // Уникальный идентификатор, генерируется автоматически по умолчанию, полезный для JQuery интеграции
                        'id' => "video-block-$i",
                        // Видео и постер ширину в пикселях
                        'width' => '100%',
                        // Видео и постер ширину в пикселях
                        'height' => '75%',
                        // Poster image absolute URL
                        'poster' => ($data[count($data)-$i]->poster)?$data[count($data)-$i]->poster:'/video-js/test-poster.png',
                        // Absolute URL of the video in MP4 format
                        'video_mp4' => 'files/videos/'.$data[count($data)-$i]->video,
                        // Absolute URL of the video in OGV format
                        'video_ogv' => 'files/videos/'.$data[count($data)-$i]->video,
                        // Absolute URL of the video in WebM format
                        'video_webm' => 'files/videos/'.$data[count($data)-$i]->video,
                        // Использовать Flash резервный плеер ?
                        'flash_fallback' => true,
                        // Адрес Пользовательский Flash плеер для использования в качестве резервного
                        'flash_player' => 'http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf',
                        // Show controls ?
                        'controls' => true,
                        // Предварительная загрузка видео контента ?
                        'preload' => false,
                        // Автостарт воспроизведения ?
                        'autoplay' => false,
                        // Показать VideoJS ссылка поддержки ?
                        'support' => false,
                        // Show video download links ?
                        'download' => false,
                        'visible'=>($i != 1)?false:true,
                    ),
                ));
                ?>
        <?php endfor;?>
        <?php for ($i=1; $i<=3; $i++):?>
        <div class="info" <?php echo ($i != 1)?'style="display: none;"':'';?>>
            <div class="comments">
                <a href="<?php echo Yii::app()->createUrl('videos/view', array('id'=>$data[count($data)-$i]->id, '#'=>'comments'));?>">Комментарии (<?php echo $data[count($data)-$i]->commentCount;?>)</a></div>
            <div class="views"><a href="<?php echo Yii::app()->createUrl('videos/view', array('id'=>$data[count($data)-$i]->id, '#'=>'video-block'));?>">Просмотры: <?php echo $data[count($data)-$i]->views;?></a></div>
        </div>
        <?php endfor;?>
    </div>
    <div class="span3">
        <?php $this->widget('application.modules.news.components.FrontNewsWidget');?>
    </div>
</div>

<div class="row">
    <?php $this->widget('FeaturedVideoWidget');?>
</div>

<div class="row">
    <?php $this->widget('FrontCategoriesWidget');?>
</div>
