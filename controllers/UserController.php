<?php

namespace app\controllers;

use app\helpers\BlankHelper;
use app\models\BlankInputs;
use app\models\Subject;
use app\models\SubjectBlanks;
use app\models\TemplateBlank;
use app\models\User;
use app\models\UserExam;
use app\models\UserSearch;
use app\models\Variant;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $userExam = new UserExam();
            $userExam->id_user = $_POST['idUser'];
            $userExam->id_variant = $_POST['variant'];
            if ($userExam->save(false)) {
                $variant = Variant::findOne(['id' => $userExam->id_variant]);
                $subjectBlanks = SubjectBlanks::find()
                    ->innerJoin('template_blank', 'template_blank.id_tb = subject_blanks.id_templateblank')
                    ->where(['id_subject' => $variant->id_subject, 'type_blank' => 'Бланк регистрации'])
                    ->asArray()
                    ->all();
                $id_tb = $subjectBlanks[0]['id_templateblank'];
                $inputs = BlankInputs::find()
                    ->where(['blank_id' => $id_tb])
                    ->asArray()
                    ->all();
                $result = BlankHelper::ParseValues($inputs);
                $template = TemplateBlank::findOne(['id_tb' => $id_tb]);
                $path = $_SERVER['DOCUMENT_ROOT'].'/web/blanks/templates/'.$template->class_templ.'/'.$template->type_test.'/'.$template->type_blank.'/'.$template->image_name;
                $subject = Subject::findOne(['id' => $variant->id_subject]);
                $params['code'] = $subject->code;
                $params['subject'] = $subject->name;
                $params['blank_name'] = $template->type_blank;
                BlankHelper::InsertInBlank($result, $path, $params);
                return ['message' => 'Тестирование назначено!'];
            }
            else {
                return ['message' => 'Произошла ошибка'];
            }
        }
        $searchModel = new UserSearch();
        $subjects = Subject::find()->asArray()->all();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $user_id User ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(): \yii\web\Response|string
    {
        $model = new User();

        if ($this->request->isPost) {
            $model = $this->PostUsersData($model);
            if ($model->save()) {
                return $this->redirect(['view', 'user_id' => $model->user_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $user_id User ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id)
    {
        $model = $this->findModel($user_id);
        if ($this->request->isPost) {
            $model = $this->PostUsersData($model);
            if ($model->save()) {
                return $this->redirect(['view', 'user_id' => $model->user_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    private function PostUsersData(User $model): User
    {
        $model->user_email_address = $_POST['User']['user_email_address'];
        $model->user_name = $_POST['User']['user_name'];
        $model->last_name = $_POST['User']['last_name'];
        return $model;
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $user_id User ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id)
    {
        $this->findModel($user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $user_id User ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id)
    {
        if (($model = User::findOne(['user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
