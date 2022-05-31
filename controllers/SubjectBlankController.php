<?php

namespace app\controllers;

use app\models\SubjectBlanks;
use app\models\SubjectBlankSearch;
use app\models\TemplateBlank;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubjectBlankController implements the CRUD actions for SubjectBlanks model.
 */
class SubjectBlankController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all SubjectBlanks models.
     *
     * @return string
     */
    public function actionIndex($id)
    {

        $searchModel = new SubjectBlankSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubjectBlanks model.
     * @param int $id_sb Id Sb
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_sb)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_sb),
        ]);
    }

    /**
     * Creates a new SubjectBlanks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($type_test)
    {
        $model = new SubjectBlanks();
        $template = TemplateBlank::find()->where(['type_test' => $type_test])->all();
        if ($this->request->isPost) {
            $model->id_subject = $_POST['SubjectBlanks']['id_subject'];
            $model->id_templateblank = $_POST['id_templateblank'];
            var_dump($_POST);
            if ($model->save()) {
                return $this->redirect(['index', 'id' => $model->id_subject, 'type_test' => $type_test]);
            }
            print_r($model->errors);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'template' => $template,
        ]);
    }

    /**
     * Updates an existing SubjectBlanks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_sb Id Sb
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_sb)
    {
        $model = $this->findModel($id_sb);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_sb' => $model->id_sb]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SubjectBlanks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_sb Id Sb
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_sb, $type_test)
    {
        $model = $this->findModel($id_sb);
        $id_c = $model->id_subject;
        $model->delete();
        return $this->redirect(['index', 'id' => $id_c, 'type_test' => $type_test]);
    }

    /**
     * Finds the SubjectBlanks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_sb Id Sb
     * @return SubjectBlanks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_sb)
    {
        if (($model = SubjectBlanks::findOne(['id_sb' => $id_sb])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
