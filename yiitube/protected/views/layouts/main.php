<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" media="screen">
    
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<link href="/video-js/video-js.css" rel="stylesheet" type="text/css">
	<script src="/video-js/video.js"></script>
	<script>
		_V_.options.flash.swf = "video-js/video-js.swf";
	</script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<!-- NOTE: Maybe, we can exclude unnecessary buttons with widget request -->
	<style type="text/css">
		li.auth-service {
			display: none;
		}
		li.auth-service.twitter, li.auth-service.facebook, li.auth-service.google, li.auth-service.vkontakte, li.auth-service.odnoklassniki {
			display: block;
		}
	</style>
</head>

<body>
<?php if(Yii::app()->user->hasFlash('success')):?>,
    <script>
        alert("<?php echo Yii::app()->user->getFlash('success');?>");
    </script>
    <?php echo Yii::app()->user->getFlash('errors');?>
<?php endif;?>
<div class="container" id="content">
        <div class="row">
            <div class="span2"><?php echo CHtml::link(CHtml::encode(Yii::app()->name), CHtml::normalizeUrl('/')); ?></div>
            <div class="span7">
                <form class="search" action="/search" method="post">
                    <input type="text" name="query" class="input-search span6">
                    <input type="submit" class="btn-search" value="">
                </form>
                <div class="social-button">
                       <?php $this->widget('SocialWidget');?>
                </div>
            </div>
            <div class="span3">
                <?php $this->widget('LoginFormWidget');?>
            </div>
        </div>

            <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
            

	<?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Categories', 'url'=>array('/categories/index')),
				array('label'=>'Videos', 'url'=>array('/videos/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				// array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
		));*/ ?>

	

	
    </div>
    
<!--    <div style="height:10px;"></div>-->
    
    <div id="footer" class="container">
        <div style="float:left;width:100%;">
            <div id="border"></div>
            <div class="left-footer">
                <?php $pages = Pages::model()->findAll();?>
                <ul class="r-menu">
                    <li><a href="/sitemap.xml">Карта сайта</a> </li> |
                    <li><a href="/site/contact">Обратная связь</a> </li> 
                    <?php foreach ($pages as $page):?>
                     | <li><a href="<?php echo $page->url;?>"><?php echo $page->title;?></a> </li>
                    <?php endforeach;?>
                </ul>
                <span>&copy Клик ТВ, 2013</span>
            </div>
            <div class="right-footer">
                <?php $this->widget('BottomMenuWidget');?>
            </div>
        </div>  
    </div><!-- footer -->

</body>
</html>
