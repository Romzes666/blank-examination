<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class MainController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
          return [
              'access' => [
                  'class' => AccessControl::class,
                  'only' => ['index'],
                  'rules' => [
                      [
                          'allow' => false,
                          'verbs' => ['POST']
                      ],
                      [
                          'allow' => true,
                          'roles' => ['@'],
                      ],
                  ],
              ],
          ];
    }

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

    public function actionLogout()
    {
        return $this->render('/site/logout');
    }
}
