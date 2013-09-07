<?php
/* @var $this SiteController */
/* @var $loginForm LoginForm */
/* @var $registerForm RegisterForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($loginForm, 'username'); ?>
        <?php echo $form->textField($loginForm, 'username'); ?>
        <?php echo $form->error($loginForm, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($loginForm, 'password'); ?>
        <?php echo $form->passwordField($loginForm, 'password'); ?>
        <?php echo $form->error($loginForm, 'password'); ?>
    </div>

    <div class="row rememberMe">
        <?php echo $form->checkBox($loginForm, 'rememberMe'); ?>
        <?php echo $form->label($loginForm, 'rememberMe'); ?>
        <?php echo $form->error($loginForm, 'rememberMe'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

<h1>Register</h1>

<div class="form">

    <?php $register = $this->beginWidget('CActiveForm', array(
        'id' => 'registration-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>

    <div class="row">
        <?php echo $register->labelEx($registerForm, 'name'); ?>
        <?php echo $register->textField($registerForm, 'name'); ?>
        <?php echo $register->error($registerForm, 'name'); ?>
    </div>
    <div class="row">
        <?php echo $register->labelEx($registerForm,'email'); ?>
        <?php echo $register->emailField($registerForm,'email'); ?>
        <?php echo $register->error($registerForm,'email'); ?>
    </div>
    <div class="row">
        <?php echo $register->labelEx($registerForm, 'password'); ?>
        <?php echo $register->passwordField($registerForm, 'password'); ?>
        <?php echo $register->error($registerForm, 'password'); ?>
    </div>
    <?php if(CCaptcha::checkRequirements()): ?>
        <div class="row">
            <?php echo $register->labelEx($registerForm,'verifyCode'); ?>
            <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $register->textField($registerForm,'verifyCode'); ?>
            </div>
            <div class="hint">Please enter the letters as they are shown in the image above.
                <br/>Letters are not case-sensitive.</div>
            <?php echo $register->error($registerForm,'verifyCode'); ?>
        </div>
    <?php endif; ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Register'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
