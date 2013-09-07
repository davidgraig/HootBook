<?php

class RegisterForm extends CFormModel
{
    public $name;
    public $password;
    public $email;
    public $verifyCode;

    public function rules()
    {
        return array(
            array('name, password, email', 'required'),
            array('email', 'email'),
            array('verifyCode', 'captcha', 'allowEmpty' => CCaptcha::checkRequirements()),
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