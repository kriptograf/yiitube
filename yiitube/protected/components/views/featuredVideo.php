<div class="span12">
    <h3 class="h-pop">Популярное видео</h3>
    <div id="container">
        <?php foreach ($videos as $video):?>
        <div class="item">
            <div class="wrap">
                <?php
                $this->widget('application.extensions.videojs.EVideoJS', array(
                    'options' => array(
                        // Уникальный идентификатор, генерируется автоматически по умолчанию, полезный для JQuery интеграции
                        'id' => 'video-'.$video->id,
                        // Видео и постер ширину в пикселях
                        'width' => '100%',
                        // Видео и постер ширину в пикселях
                        'height' => '75%',
                        // Poster image absolute URL
                        'poster' => '/video-js/test-poster.png',
                        // Absolute URL of the video in MP4 format
                        'video_mp4' => '/files/videos/'.$video->video,
                        // Absolute URL of the video in OGV format
                        'video_ogv' => '/files/videos/'.$video->video,
                        // Absolute URL of the video in WebM format
                        'video_webm' => '/files/videos/'.$video->video,
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
                    ),
                ));
                ?>  
                <small>Просмотров: <?php echo $video->views;?></small>
                <p class="date-video"><?php echo date('d.m.Y',  strtotime($video->time));?></p>
                <h4 class="h-video"><a href="<?php echo Yii::app()->createUrl('videos/view', array('id'=>$video->id));?>"><?php echo $video->name;?></a></h4>
                <p><?php echo $video->description;?></p>
                <a href="<?php echo Yii::app()->createUrl('videos/view', array('id'=>$video->id, '#'=>'comments'));?>" class="count-comment">Комментарии(<?php echo $video->commentCount;?>)</a>
            </div>
        </div>
        <?php endforeach;?>        
    </div>
</div>
