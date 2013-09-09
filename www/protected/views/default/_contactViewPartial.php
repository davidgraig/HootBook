
<?php
/* @var $this ContactController */
/* @var $data Contact */
?>

<div class="view">

    <?php echo CHtml::image($data->getTwitterImage()); ?>
    <?php echo CHtml::encode($data->getFullName()); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
    <?php echo CHtml::encode($data->phone); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('twitter')); ?>:</b>
    @<?php echo CHtml::encode($data->twitter); ?>
    <br />

    <b><?php echo CHtml::encode('Followers:'); ?></b>
    <?php
        $followers = CHtml::encode($data->getFollowers());
        if ($followers == TwitterCache::INVALID_HANDLE)
        {
            echo "<span class='unknown-twitter'>unknown twitter account</span>";
        }
        else if ($followers === TwitterCache::NEVER_UPDATED)
        {
            echo "???";
        }
        else
        {
            echo $followers;
        }
    ?>
    <br/>

    <b><?php echo Chtml::link('Edit', array("contact/update/$data->id")); ?></b>
    <br/>

    <b><?php echo Chtml::link('Delete', array("contact/delete/$data->id"), array('confirm' => 'Are you sure?')); ?></b>
    <br/>

</div>