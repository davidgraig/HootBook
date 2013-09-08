<h1>Contacts</h1>

<?php
$this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_contactViewPartial',
        'emptyText' => "You don't have any contacts.",
        'enablePagination' => true,
    )
);
?>

<div class="view form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'create-contact-form',
        'action' => Yii::app()->createUrl('contact/create'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($newContact, 'first_name'); ?>
        <?php echo $form->textField($newContact, 'first_name'); ?>
        <?php echo $form->error($newContact, 'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($newContact, 'last_name'); ?>
        <?php echo $form->textField($newContact, 'last_name'); ?>
        <?php echo $form->error($newContact, 'last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($newContact, 'phone'); ?>
        <?php $this->widget('CMaskedTextField', array(
            'model' => $newContact,
            'attribute' => 'phone',
            'mask' => '(999) 999-9999',
            'htmlOptions' => array('size' => 10)
        )); ?>
        <?php echo $form->error($newContact, 'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($newContact, 'twitter'); ?>
        <?php echo $form->textField($newContact, 'twitter'); ?>
        <?php echo $form->error($newContact, 'twitter'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Add'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
