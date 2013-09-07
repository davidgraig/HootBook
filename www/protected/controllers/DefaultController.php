<?php

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $loginForm = new LoginForm;
        $registerForm = new RegisterForm;
        $this->render('index', array(
                'loginForm' => $loginForm,
                'registerForm' => $registerForm,
            )
        );
    }

    public function actionLogin()
    {

        $loginForm = new LoginForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($loginForm);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $loginForm->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($loginForm->validate() && $loginForm->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionRegister()
    {
        $registerForm = new RegisterForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'registration-form') {
            echo CActiveForm::validate($registerForm);
            Yii::app()->end();
        }

        if (isset($_POST['RegisterForm'])) {
            $registerForm->attributes = $_POST['RegisterForm'];

            if ($registerForm->validate()) {
                if (User::model()->findByAttributes(array('email' => $registerForm->email)) === null) {
                    $user = $registerForm->register();
                    if (!$user->hasErrors()) {
                        Yii::app()->user->setFlash('success', "Welcome, $user->name!");
                        $this->render('register', array('user' => $user));
                    } else {
                        foreach ($user->getErrors() as $error) {
                            Yii::app()->user->setFlash('error', $error);
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('error', "The user already exists");
                }
            } else {
                Yii::app()->user->setFlash('error', "The form has errors, please fix them");
            }
        } else {
            Yii::app()->user->setFlash('error', "Nothing was submitted");
        }

        $this->redirect(Yii::app()->user->returnUrl);

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