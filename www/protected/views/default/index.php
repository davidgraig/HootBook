<h1>Contacts</h1>

<?php $this->widget('zii.widgets.CListView', array('dataProvider' => $dataProvider, 'itemView' => '_contactViewPartial', 'emptyText' => "You don't have any contacts.")); ?>

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
        <?php echo $form->labelEx($contact, 'first_name'); ?>
        <?php echo $form->textField($contact, 'first_name'); ?>
        <?php echo $form->error($contact, 'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($contact, 'last_name'); ?>
        <?php echo $form->textField($contact, 'last_name'); ?>
        <?php echo $form->error($contact, 'last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($contact, 'phone'); ?>
        <?php echo $form->textField($contact, 'phone'); ?>
        <?php echo $form->error($contact, 'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($contact, 'twitter'); ?>
        <?php echo $form->textField($contact, 'twitter'); ?>
        <?php echo $form->error($contact, 'twitter'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Add'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
