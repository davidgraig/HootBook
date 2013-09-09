<?php

$this->pageTitle = Yii::app()->name;

Yii::app()->clientScript->registerScript('search',
    "var ajaxUpdateTimeout;
    var ajaxRequest;
    $('input#search').keyup(function(){
        ajaxRequest = $(this).serialize();
        clearTimeout(ajaxUpdateTimeout);
        ajaxUpdateTimeout = setTimeout(function () {
            $.fn.yiiListView.update('yw0',{data: ajaxRequest})
        },
    500);
});");
?>
<div id="contact-search">
    <b><label for="search">Search Contact Name: </label></b>
    <input type="text" id="search" name="search" />
</div>
<?php
$this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_contactViewPartial',
        'emptyText' => "No contacts found.",
        'enablePagination' => true,
        'sortableAttributes' => array(
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'twitter' => 'Twitter Handle',
            'phone',
        ),
    )
);
?>

<div id="add-contact-form" class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'create-contact-form',
        'action' => Yii::app()->createUrl('contact/create'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>

    <div>
        <?php echo $form->labelEx($newContact, 'first_name'); ?>
        <?php echo $form->textField($newContact, 'first_name'); ?>
        <?php echo $form->error($newContact, 'first_name'); ?>
    </div>

    <div>
        <?php echo $form->labelEx($newContact, 'last_name'); ?>
        <?php echo $form->textField($newContact, 'last_name'); ?>
        <?php echo $form->error($newContact, 'last_name'); ?>
    </div>

    <div>
        <?php echo $form->labelEx($newContact, 'phone'); ?>
        <?php $this->widget('CMaskedTextField', array(
                'model' => $newContact,
                'attribute' => 'phone',
                'mask' => '(999) 999-9999',
                'htmlOptions' => array('autocomplete' => 'off')
            )
        ); ?>
        <?php echo $form->error($newContact, 'phone'); ?>
    </div>

    <div>
        <?php echo $form->labelEx($newContact, 'twitter'); ?>
        <?php echo $form->textField($newContact, 'twitter'); ?>
        <?php echo $form->error($newContact, 'twitter'); ?>
    </div>

    <div class="buttons">
        <?php echo CHtml::submitButton('Add Contact', array('class' => 'contact-form-submit')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
