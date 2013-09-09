<?php

class UserController extends Controller
{

    public function actionUpdate($id)
    {
        if (Yii::app()->user->id == $id) {

            $model = $this->loadModel($id);

            if (isset($_POST['User'])) {
                $oldPassHash = $model->password;
                $model->attributes = $_POST['User'];

                $model->password = $model->password === null ? $oldPassHash : CPasswordHelper::hashPassword($model->password);

                if ($model->save()) {
                    Yii::app()->user->setFlash('success', 'Profile updated, please logout and log back in to see your changes.');
                    $this->redirect(Yii::app()->getHomeUrl());
                }
            } else if (isset($_POST['delete'])) {

                $delete = $_POST['delete'];

                if ($delete == strtolower('delete')) {
                    $this->loadModel($id)->delete();
                    Yii::app()->user->setFlash('success', 'You have closed your HootBook account');
                    Yii::app()->user->logout();
                    $this->redirect(Yii::app()->getHomeUrl());
                    return;
                } else {
                    Yii::app()->user->setFlash('notice', 'You did not delete your account, please type &quot;delete&quot; into the delete text field.');
                }
            }

            $model->password = '';
            $this->render('update', array(
                'model' => $model,
            ));
        } else {
            Yii::app()->user->setFlash('error', 'You do not have access to do that');
            $this->redirect(Yii::app()->getHomeUrl());
        }
    }






    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('update'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
