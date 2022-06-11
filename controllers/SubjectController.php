<?php

namespace app\controllers;

use app\models\Errors;
use app\models\Subject;
use app\models\SubjectBlanks;
use app\models\SubjectSearch;
use app\models\Task;
use app\models\TemplateBlank;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SubjectController implements the CRUD actions for Subject model.
 */
class SubjectController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Subject models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new SubjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subject model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Subject model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBlank(int $id): string
    {
        return $this->render('blank',[
            'model' => $this->findModel($id),
            'blanks' => (new \yii\db\Query())->from('template_blank')->select(['template_blank.*'])
                ->innerJoin('subject_blanks','`template_blank`.`id_tb` = `subject_blanks`.`id_templateblank`')
                ->innerJoin('subject', '`subject`.`id` = `subject_blanks`.`id_subject`')
                ->where(['subject_blanks.id_subject' => $id])
                ->all(),
        ]);
    }
    /**
     * Creates a new Subject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate(): Response|string
    {
        $subject = new Subject();
        if ($this->request->isPost) {
            $subject->name = $_POST['Subject']['name'];
            $subject->class = $_POST['Subject']['class'];
            $subject->type = $_POST['Subject']['type'];
            $subject->count_task = $_POST['Subject']['count_task'];
            if($subject->save()){
                $model_id = $subject->id;
                if (Task::saveTask($model_id)) {
                    return $this->redirect(['view', 'id' => $subject->id]);
                }
                throw new Exception('Произошла ошибка во время сохранения заданий.');
            }
            print_r($subject->errors);
        }
        else {
            $subject->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $subject,
        ]);
    }

    /**
     * Updates an existing Subject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id): Response|string
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
     * Deletes an existing Subject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Subject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Subject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Subject
    {
        if (($model = Subject::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
