<?php
ob_start(); //login seems to send it's headers, so we will capture all it's output.
class LoginFormTest extends CDbTestCase
{

    public function testLogin()
    {
        $loginForm = new LoginForm();
        $loginForm->email = "newTest@test.com";
        $loginForm->password = "test";


        //TODO: implement IoC to remove the call to UserIdentity.
       $result =  $loginForm->login();

        $this->assertTrue($result);
    }
}