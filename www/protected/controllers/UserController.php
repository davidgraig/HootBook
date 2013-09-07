<?php

class UserController extends Controller
{


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        if (Yii::app()->user->id == $id)
        {
            $model = $this->loadModel($id);
            $oldPassHash = $model->password;
            if(isset($_POST['User']))
            {
                $model->attributes=$_POST['User'];

                $model->password = $model->password === null ? $oldPassHash : CPasswordHelper::hashPassword($model->password);

                if($model->save())
                {
                    Yii::app()->user->setFlash('success', 'Profile updated, please logout and log back in to see your changes.');
                    $this->redirect(Yii::app()->user->returnUrl);
                }

            }
            else
            {
                $model->password = '';
            }

            $this->render('update',array(
                'model'=>$model,
            ));
        }
        else
        {
            Yii::app()->user->setFlash('error', 'You do not have access to do that');
            $this->redirect(Yii::app()->user->returnUrl);
        }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        if (Yii::app()->user->id == $id)
        {
            $this->loadModel($id)->delete();
            Yii::app()->user->setFlash('success', 'You have closed your HootBook account');
            Yii::app()->user->logout();
        }
        else
        {
            Yii::app()->user->setFlash('error', 'You do not have access to do that');
            $this->redirect(Yii::app()->user->returnUrl);
        }
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
