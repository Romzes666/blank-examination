<?php

namespace app\controllers;

use app\components\VariantComponent;
use app\models\Answers;
use app\models\Subject;
use app\models\Variant;
use app\models\VariantSearch;
use Imagick;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VariantController implements the CRUD actions for Variant model.
 */
class VariantController extends Controller
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
     * Lists all Variant models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new VariantSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Variant model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Variant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new Variant();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if (isset($_POST['action'])) {
                $template = Subject::findOne([
                    'name' => $_POST['name'],
                    'type' => $_POST['type_test'],
                    'class' => $_POST['class_templ']
                ]);
                if (is_null($template)) {
                    $output = [
                        'success' => false,
                        'error' => 'Предмет по таким параметрам не найден....'
                    ];
                    return $output;
                } else {
                    $output = [
                        'success' => true,
                        'template' => $template->tasks
                    ];
                    return $output;
                }
            }
            else {
                $path = $_SERVER['DOCUMENT_ROOT'] . '/web/upload/kim/';
                $new_name = VariantComponent::saveFile($path, $_FILES['kim']);
                $new_path = $_SERVER['DOCUMENT_ROOT']. '/web/upload/variant/' . $_POST['number'] . '/';
                $count_task = VariantComponent::kimFragmentation($new_name, $path, $new_path);
                $model->kim = $new_name;
                $model->count_list = $count_task;
                $model->number = $_POST['number'];
                $model->id_subject = $_POST['id_subject'];
                if ($model->save()) {
                    for($i = 0; $i < $_POST['count']; ++$i){
                        $id_task = $_POST['id_task'.$i];
                        for ($j = 0; $j < count($_POST['answer'.$i]); ++$j) {
                            $answer = new Answers();
                            $answer->id_variant = $model->id;
                            $answer->score = $_POST['score'.$i][$j];
                            $answer->answer = $_POST['answer'.$i][$j];
                            $answer->id_task = $id_task;
                            if ($answer->save()) {
                                return $this->redirect(['view', 'id' => $model->id]);
                            }
                        }
                    }
                }
                throw new Exception('Произошла ошибка во время сохранения варианта.');

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Variant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Variant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Variant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Variant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Variant::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
