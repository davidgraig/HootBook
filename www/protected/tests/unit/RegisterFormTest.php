<?php

class RegisterFormTest extends CDbTestCase
{

    public function testRegister()
    {
        $registerForm = new RegisterForm();
        $registerForm->password = "test";
        $registerForm->email = "newTest@test.com";
        $registerForm->name = "test";

        $user = $registerForm->register();

        $dbUser = User::model()->findByPk($user->id);

        $this->assertEquals($user->email, $dbUser->email);

        $this->getFixtureManager()->truncateTable('user');

    }

}