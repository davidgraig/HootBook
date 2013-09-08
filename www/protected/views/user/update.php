<h1>Edit Profile</h1>
<?php echo CHtml::link('Back to Contacts', '/default/index'); ?>
<br/>
<br/>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

    <hr/>

    <h2>Delete Your Account:</h2>
    <p class="note">please type &quot;delete&quot; into the text field below.</p>
    <?php
        echo CHtml::beginForm('/user/update/' . Yii::app()->user->id, 'post', array('name' => 'DeleteUser'));
        echo CHtml::textField('delete');
        echo CHtml::submitButton('Delete your Account');
        echo CHtml::endForm();
    ?>

</div><!-- form -->