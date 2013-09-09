<?php

class RegisterForm extends CFormModel
{
    public $name;
    public $password;
    public $email;
    public $verifyCode;
    public $captcha;

    public function rules()
    {
        return array(
            array('name, password, email, verifyCode', 'required'),
            array('email', 'email'),
            array('verifyCode', 'captcha', 'allowEmpty' => CCaptcha::checkRequirements()),
            array('name, email', 'filter', 'filter' => array(new CHtmlPurifier(), 'purify')),
        );
    }

    public function attributeLabels()
    {
        return array( 'verifyCode' => 'Verification Code');
    }

    public function register()
    {
        $hash = CPasswordHelper::hashPassword($this->password);
        $user = new User();
        $user->name = $this->name;
        $user->password = $hash;
        $user->email =  $this->email;
        $user->save();
        return $user;
    }


}