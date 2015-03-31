<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 07.03.13
 * Time: 19:26
 * To change this template use File | Settings | File Templates.
 */
?>
<h2 class="section-title">Новости</h2>
<ul class="news-widget">
    <?php foreach($news as $new):?>
    <li>
        <span class="time"><?php echo date("d.m.Y",  strtotime($new->UpdatedDate));?></span> 
        <div class="news-intro">
            <a href="<?php echo Yii::app()->createUrl('news/news/view', array('id'=>$new->id_news));?>" id="news<?php echo $new->id_news;?>">
                <?php echo Common::crop(strip_tags($new->content), 70);?>
            </a>
        </div> 
    </li>
    <?php endforeach;?>
</ul>
<a href="/news" title="Все новости">Все новости</a>
