<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'icon'); ?>
                <?php echo $form->hiddenField($model, 'icon');?>
		<?php echo $form->fileField($model,'icon'); ?>
		<?php echo $form->error($model,'icon'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'top'); ?>
		<?php echo $form->checkBox($model,'top'); ?>
		<?php echo $form->error($model,'top'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'parent_id'); ?>
		<?php //echo $form->dropDownList($model,'parent_id',$parents); ?>
		<?php //echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->