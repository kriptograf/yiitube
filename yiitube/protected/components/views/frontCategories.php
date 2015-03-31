<div class="span12">
    <h3 class="h-cat">Видео по категориям</h3>
    <div id="container2">
        <?php foreach ($categories as $cat):?>
        <div class="item">
            <div class="wrap">
                <h4 class="h-for-cat">
                    <a href="<?php echo Yii::app()->createUrl('categories/view', array('id'=>$cat->id));?>"><?php echo $cat->name;?></a>
                </h4>
                <img src="/content/categories/<?php echo $cat->icon;?>" > 
                <p><?php echo $cat->description;?></p>
            </div>
        </div>
        <?php endforeach;?>   
    </div>
</div>
