<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div id="header">
        <div id="logo"><a href="/"><?php echo CHtml::encode(Yii::app()->name); ?></a></div>
    </div>
    <!-- header -->

    <div id="mainmenu">
        <?php $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/default/logout'), 'visible' => !Yii::app()->user->isGuest),
                array('label' => 'Edit Profile', 'url' => array('/user/update/' . Yii::app()->user->id), 'visible' => !Yii::app()->user->isGuest),
            ),
        )); ?>
    </div>
    <!-- mainmenu -->
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
    <?php endif ?>

    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        if (is_array($message)) {
            foreach ($message as $flash) {
                echo "<div class='flash-$key'>$flash</div><br/>";
            }
        } else {
            echo "<div class='flash-$key'>$message</div><br/>";
        }
    }

    ?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> Dave Russell.<br/>
    </div>
    <!-- footer -->

</div>
<!-- page -->

</body>
</html>
