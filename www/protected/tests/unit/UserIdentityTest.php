<?php

class UserIdentityTest extends CTestCase
{

    public function testAuthenticate()
    {
        $registerForm = new RegisterForm();
        $registerForm->attributes = array(
            'name' => 'test',
            'email' => 'newTest@test.com',
            'password' => 'test'
        );
        $registerForm->register();

        $identity = new UserIdentity("newTest@test.com", "test");
        $identity->authenticate();
        $this->assertEquals(UserIdentity::ERROR_NONE, $identity->errorCode);
    }

}