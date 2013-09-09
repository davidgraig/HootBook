<?php

/**
 * Class DefaultController - Main controller for application flow: login/out
 */
class DefaultController extends Controller
{

    public function actionIndex($search = '')
    {
        if (Yii::app()->user->isGuest) {
            $this->render('login', array(
                    'loginForm' => new LoginForm,
                    'registerForm' => new RegisterForm,
                )
            );
        } else {

            $twitter_cache = new TwitterCache();
            $twitter_cache->refreshCache();

            $dataProvider = new CActiveDataProvider('Contact', array(
                'pagination' => array(
                    'pageSize' => 8,
                ),
            ));

            $criteria = new CDbCriteria();
            $criteria->addCondition('user_id = ' . Yii::app()->user->id);
            $criteria->addSearchCondition('last_name', $search, true, 'OR');
            $criteria->addSearchCondition('first_name', $search, true, 'OR');
            $criteria->addSearchCondition('twitter', $search, true, 'OR');
            $criteria->addSearchCondition('phone', $search, true, 'OR');
            $criteria->order = 'last_name ASC';
            $dataProvider->setCriteria($criteria);

            $this->render('index', array(
                    'dataProvider' => $dataProvider,
                    'newContact' => new Contact
                )
            );
        }
    }

    public function actionLogin()
    {
        $loginForm = new LoginForm;

        if (isset($_POST['LoginForm'])) {
            $loginForm->attributes = $_POST['LoginForm'];
            if ($loginForm->validate() && $loginForm->login()) {
                Yii::app()->user->setFlash('success', 'Welcome ' . Yii::app()->user->name);
            } else {
                foreach ($loginForm->getErrors() as $error) {
                    Yii::app()->user->setFlash('error', $error);
                }

            }
        }

        $this->redirect(Yii::app()->getHomeUrl());
    }

    public function actionRegister()
    {
        $registerForm = new RegisterForm;

        if (isset($_POST['RegisterForm'])) {
            $registerForm->attributes = $_POST['RegisterForm'];

            if ($registerForm->validate()) {
                if (User::model()->findByAttributes(array('email' => $registerForm->email)) === null) {
                    $user = $registerForm->register();
                    if (!$user->hasErrors()) {
                        Yii::app()->user->setFlash('success', "Welcome, $user->name!");
                        $loginForm = new LoginForm();
                        $loginForm->email = $registerForm->email;
                        $loginForm->password = $registerForm->password;
                        $loginForm->login();
                    } else {
                        foreach ($user->getErrors() as $error) {
                            Yii::app()->user->setFlash('error', $error);
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('error', "A user with that email address already exists.");
                }
            } else {
                Yii::app()->user->setFlash('error', "The form has errors, please fix them");
            }
        } else {
            Yii::app()->user->setFlash('error', "Nothing was submitted");
        }

        $this->redirect(Yii::app()->getHomeUrl());

    }


    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->getHomeUrl());
    }

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
            {
                echo $error['message'];;

            }
            else
            {
                $this->render('error', $error);
            }

            Yii::log($error['message'], 'error');
            Yii::trace($error['message']);

        }
    }


    /**
     * Declares actions defined in other classes
     */
    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }
}