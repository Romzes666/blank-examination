<?php

namespace app\controllers;

class MainController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionChangePassword()
    {
        return $this->render('change-password');
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

    public function actionInformation()
    {
        return $this->render('information');
    }

    public function actionSupport()
    {
        return $this->render('support');
    }

}
