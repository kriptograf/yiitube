<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::app()->clientScript->registerScriptFile('/js/jflow.plus.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile('/css/jflow.style.css');
?>
<div style="height: 280px;width: 735px; margin-bottom: 20px; background: #f0f0f0;">
    <div id="sliderContainer">
        <div id="mySlides">
            <?php foreach ($news as $item):?>
            <div id="slide<?php echo $item->id_news;?>" class="slide">
                <a href="<?php echo Yii::app()->createUrl('/news/view/show',  array('id'=>$item->id_news))?>">
                <img src="/content/news/<?php echo $item->image;?>" alt="<?php echo $item->title;?>"/>
                </a>
                <div class="slideContent">
                    <div class="slide-date"><?php echo Yii::app()->dateFormatter->format("HH:mm | dd MMMM yyyy ", strtotime($item->UpdatedDate), 'long'); ?></div> 
                    <h3 class="slide-title"><?php echo $item->title;?></h3>
                    <br><br>
                    <div class="slide-content"><?php echo Kupons::crop($item->content, 150); ?></div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div id="myController">
            <?php for ($i=0;$i<count($news);$i++):?>
            <span class="jFlowControl"></span> 
            <?php endfor;?>
        </div>
        <div class="jFlowPrev"></div>
        <div class="jFlowNext"></div>
    </div>
    <!--end: jFlow DOM -->
</div><!-- end slider block -->

<script type="text/javascript">

        $(function () {

            $("#myController").jFlow({

                controller: ".jFlowControl", // must be class, use . sign

                slideWrapper: "#jFlowSlider", // must be id, use # sign

                slides: "#mySlides",  // the div where all your sliding divs are nested in

                selectedWrapper: "jFlowSelected",  // just pure text, no sign

                effect: "flow", //this is the slide effect (rewind or flow)

                width: "735px",  // this is the width for the content-slider

                height: "280px",  // this is the height for the content-slider

                duration: 6000,  // time in milliseconds to transition one slide

                pause: 6000, //time between transitions

                prev: ".jFlowPrev", // must be class, use . sign

                next: ".jFlowNext", // must be class, use . sign

                auto: true

            });

        });

    </script>
