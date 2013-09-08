<?php

class ContactController extends Controller
{
    public function actionCreate()
    {
        $model = new Contact;
        $userId = Yii::app()->user->id;
        if (isset($_POST['Contact'])) {
            $model->attributes = $_POST['Contact'];
            $model->user_id = $userId;
            $model->twitter = ltrim($model->twitter, '@');

            if ($model->save()) {
                $this->updateTwitterCache($model);

                $fullName = $model->getFullName();
                Yii::app()->user->setFlash('success', "$fullName was created.");
            }
            else
            {
                foreach ($model->getErrors() as $error)
                {
                    Yii::app()->user->setFlash('error', $error);
                }
            }
        }
        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Contact'])) {
            $model->attributes = $_POST['Contact'];

            $model->twitter = ltrim($model->twitter, '@');

            if ($model->save()) {

                $this->updateTwitterCache($model);

                $fullName = $model->getFullName();
                Yii::app()->user->setFlash('success', "$fullName was updated.");
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : Yii::app()->user->returnUrl);
    }

    public function loadModel($id)
    {
        $model = Contact::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }




    private function updateTwitterCache($model)
    {
        $twitter_cache = TwitterCache::model()->findByAttributes(array('handle' => $model->twitter));
        if ($twitter_cache == null)
        {
            $twitter_cache = new TwitterCache;
            $twitter_cache->handle = $model->twitter;
            $twitter_cache->followers = TwitterCache::NEVER_UPDATED;
            $twitter_cache->last_update = TwitterCache::NEVER_UPDATED;
            $twitter_cache->save();
        }
    }

}
