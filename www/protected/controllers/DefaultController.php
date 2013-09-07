<?php

class DefaultController extends Controller
{
    public function actionIndex()
    {
        if (Yii::app()->user->isGuest)
        {
            $this->render('login', array(
                    'loginForm' => new LoginForm,
                    'registerForm' => new RegisterForm,
                )
            );
        }
        else
        {
            $this->render('index', array(
                    'dataProvider' => new CActiveDataProvider('Contact'),
                    'contact' => new Contact
                )
            );
        }
    }

    public function actionLogin()
    {
        $loginForm = new LoginForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
        {
            echo CActiveForm::validate($loginForm);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm']))
        {
            $loginForm->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($loginForm->validate() && $loginForm->login())
            {
                Yii::app()->user->setFlash('success', 'Welcome ' . Yii::app()->user->name);
            }
            else
            {
                foreach ($loginForm->getErrors() as $error)
                {
                    Yii::app()->user->setFlash('error', $error);
                }

            }
        }

        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionRegister()
    {
        $registerForm = new RegisterForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'registration-form')
        {
            echo CActiveForm::validate($registerForm);
            Yii::app()->end();
        }

        if (isset($_POST['RegisterForm']))
        {
            $registerForm->attributes = $_POST['RegisterForm'];

            if ($registerForm->validate())
            {
                if (User::model()->findByAttributes(array('email' => $registerForm->email)) === null) {
                    $user = $registerForm->register();
                    if (!$user->hasErrors())
                    {
                        Yii::app()->user->setFlash('success', "Welcome, $user->name!");
                        $loginForm = new LoginForm();
                        $loginForm->email = $registerForm->email;
                        $loginForm->password = $registerForm->password;
                        $loginForm->login();
                    }
                    else
                    {
                        foreach ($user->getErrors() as $error)
                        {
                            Yii::app()->user->setFlash('error', $error);
                        }
                    }
                }
                else
                {
                    Yii::app()->user->setFlash('error', "The user already exists");
                }
            }
            else
            {
                Yii::app()->user->setFlash('error', "The form has errors, please fix them");
            }
        }
        else
        {
            Yii::app()->user->setFlash('error', "Nothing was submitted");
        }

        $this->redirect(Yii::app()->user->returnUrl);

    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }
}