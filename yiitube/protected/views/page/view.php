<?php
/* @var $this PageController */
/* @var $model Pages */

//$this->breadcrumbs=array(
//	'Pages'=>array('index'),
//	$model->title,
//);
?>

<div class="wrapper layout">
    <div class="wrapper-inner">
      
        <div class="equal">
            <div class="main">
                <div class="company-about">
                    <h2><?php echo $model->title; ?></h2>
                </div>
                <div class="noreset">
                        <?php echo $model->text;?>
                </div>
            </div>  <!-- ### end main section -->
            <div class="sidebar">
                
            </div>  <!-- ### end sidebar section -->
        </div>

    </div>
</div>

