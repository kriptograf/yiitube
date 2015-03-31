<?php 
$this->setTitle('Регистрация нового пользователя');
$this->breadcrumbs=array(
	'Регистрация нового пользователя',
);
?>

<h1><?php echo 'Регистрация нового пользователя'; ?></h1>



<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
		//'validateOnSubmit'=>true,
	),
	//'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model)); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'username'); ?>
	<?php echo $form->textField($model,'username'); ?>
	<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">Минимум 4 символа.</p>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'email'); ?>
	<?php echo $form->textField($model,'email'); ?>
	<?php echo $form->error($model,'email'); ?>
	</div>
        
        <div class="row">
	<?php echo $form->labelEx($model,'full_name'); ?>
	<?php echo $form->textField($model,'full_name'); ?>
	<?php echo $form->error($model,'full_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo Yii::t('app',"Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo Yii::t('app',"Letters are not case-sensitive."); ?></p>
	</div>

	
	<div class="row submit">
		<?php echo CHtml::submitButton('Регистрация'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->