<?php

class DefaultController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'users' => array('@')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    function init() {
        
    }

    public function actionIndex() {
        $model = PaypalSetting::model()->findByPk(1);

        if (isset($_POST['PaypalSetting'])) {
            $model->attributes = $_POST['PaypalSetting'];
            if ($model->validate()) {
                // form inputs are valid, do something here
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', "Changes saved successfully saved!");
                    $this->redirect(array('/SimplePaypal'));
                }
            }
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

}