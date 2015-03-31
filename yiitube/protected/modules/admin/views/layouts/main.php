<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
        
        <?php if(!Yii::app()->user->isGuest):?>
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Открыть сайт', 'url'=>'/', 'linkOptions'=>array('target'=>'_blank')),
				array('label'=>'Новости', 'url'=>array('/admin/news')),
                                array('label'=>'Страницы', 'url'=>array('/admin/page')),
				array('label'=>'Категории', 'url'=>array('/admin/categories')),
				array('label'=>'Видео', 'url'=>array('/admin/videos')),
                                array('label'=>'Комментарии', 'url'=>array('/admin/comment')),
				array('label'=>'Пользователи', 'url'=>array('/admin/users')),
                                array('label'=>'Социальные кнопки', 'url'=>array('/admin/social')),
				//array('label'=>'Войти', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Регистрация', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
        <?php endif;?>

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
	
	<?php if(Yii::app()->user->hasFlash('message')):?>
	<div style="background: #f0f0f0;padding:20px;">
	<?php echo Yii::app()->user->getFlash('message','');?>
	</div>
	<?php endif;?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>