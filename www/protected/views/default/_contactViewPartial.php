
<?php
/* @var $this ContactController */
/* @var $data Contact */
?>

<div class="view">

    <?php echo CHtml::encode($data->getFullName()); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
    <?php echo CHtml::encode($data->phone); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('twitter')); ?>:</b>
    <?php echo CHtml::encode($data->twitter); ?>
    <br />

    <b><?php echo CHtml::encode('Followers:'); ?></b>
    <?php echo CHtml::encode($data->getFollowers()); ?>
    <br/>

    <b><?php echo Chtml::link('Edit', array("contact/update/$data->id")); ?></b>
    <br/>

    <b><?php echo Chtml::link('Delete', array("contact/delete/$data->id")); ?></b>
    <br/>

</div>