<?php

namespace app\controllers;

use app\models\BlankInputs;
use app\models\TemplateBlank;
use app\models\TemplateBlankSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Exception;


/**
 * TemplateBlankController implements the CRUD actions for TemplateBlank model.
 */
class TemplateBlankController extends Controller
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
     * Lists all TemplateBlank models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TemplateBlankSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TemplateBlank model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_tb)
    {
        $inputs = BlankInputs::find()->where(['blank_id' => $id_tb])->all();
        return $this->render('view', [
            'model' => $this->findModel($id_tb),
            'inputs' => $inputs,
        ]);
    }

    /**
     * Creates a new TemplateBlank model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new TemplateBlank();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $model->type_blank = $_POST['TemplateBlank']['type_blank'];
            $model->type_test = $_POST['TemplateBlank']['type_test'];
            $model->class_templ = $_POST['TemplateBlank']['class_templ'];
            $model->image_name = 'list.jpg';

            if (isset($_POST['checkInputs'])) {
                $len = $_POST['width'];
                $model->input_count = count($len);
                if ($model->save()) {
                    if ($this->blankUpload($model)) {
                        if (BlankInputs::saveBlankInputs($model->id_tb)) {
                            return $this->redirect(['view', 'id_tb' => $model->id_tb]);
                        }
                        throw new Exception('Произошла ошибка во время сохранения текстовых полей.');
                    }
                    throw new Exception('Произошла ошибка во время сохранения бланка.');
                }
            }

            $model->input_count = 0;

            if ($model->save()) {
                if ($this->blankUpload($model)) {
                    return $this->redirect(['view', 'id_tb' => $model->id_tb]);
                }
                throw new Exception('Произошла ошибка во время сохранения бланка.');
            }
            throw new Exception('Произошла ошибка во время сохранения бланка.');
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TemplateBlank model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_tb)
    {
        $model = $this->findModel($id_tb);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_tb' => $model->id_tb]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TemplateBlank model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_tb ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_tb)
    {
        $this->findModel($id_tb)->delete();

        return $this->redirect(['index']);
    }

    private function blankUpload($model) : bool
    {
        $blank = $_FILES['blank'];
        $extension = pathinfo($blank['name'], PATHINFO_EXTENSION);
        $path = $_SERVER['DOCUMENT_ROOT'].'/web/blanks/templates/'.
            $model->class_templ . '/' .
            $model->type_test . '/' .
            $model->type_blank . '/';
        if (!is_dir($path)) {
            mkdir($path,0777, true);
        }
        $new_name = 'list.jpg';
        $_source_path = $blank['tmp_name'];
        $target_path = $path . $new_name;
        if (move_uploaded_file($_source_path, $target_path)) {
            return true;
        }
        return false;
    }

    /**
     * Finds the TemplateBlank model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_tb ID
     * @return TemplateBlank the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_tb)
    {
        if (($model = TemplateBlank::findOne(['id_tb' => $id_tb])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
