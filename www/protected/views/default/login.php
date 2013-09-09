<?php $this->pageTitle = Yii::app()->name; ?>
<div class="login form">
    <h2>Login</h2>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'action' => Yii::app()->createUrl('default/login'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($loginForm, 'email'); ?>
        <?php echo $form->textField($loginForm, 'email'); ?>
        <?php echo $form->error($loginForm, 'email'); ?>
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

<div class="register form">
<h2>Register</h2>
    <?php $register = $this->beginWidget('CActiveForm', array(
        'id' => 'registration-form',
        'action' => Yii::app()->createUrl('default/register'),
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
        <?php echo $register->labelEx($registerForm, 'email'); ?>
        <?php echo $register->emailField($registerForm, 'email'); ?>
        <?php echo $register->error($registerForm, 'email'); ?>
    </div>
    <div class="row">
        <?php echo $register->labelEx($registerForm, 'password'); ?>
        <?php echo $register->passwordField($registerForm, 'password'); ?>
        <?php echo $register->error($registerForm, 'password'); ?>
    </div>
    <?php if (CCaptcha::checkRequirements()): ?>
        <div class="row">
            <?php echo $register->labelEx($registerForm, 'verifyCode'); ?>
            <div>
                <div id="register-captcha"><?php $this->widget('CCaptcha'); ?></div>
                <?php echo $register->textField($registerForm, 'verifyCode'); ?>
            </div>
            <?php echo $register->error($registerForm, 'verifyCode'); ?>
        </div>
    <?php endif; ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Register'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>