<ul class="main-menu">
    <li><a href="/" title="На главную"><img src="images/home.png"></a> </li>
    <?php foreach ($model as $item):?>
    <li>
        <a href="<?php echo Yii::app()->createUrl('categories/view',array('id'=>$item->id));?>" title="<?php echo $item->description;?>">
            <?php echo $item->name;?>
        </a> 
    </li>
    <?php endforeach;?>
</ul>

