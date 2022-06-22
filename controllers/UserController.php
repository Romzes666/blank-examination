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
            if ($_POST['action'] === 'findVariant') {
                $template = Subject::findOne([
                    'name' => $_POST['subject'],
                    'type' => $_POST['typeTest'],
                ]);
                if (is_null($template)) {
                    $output = [
                        'success' => false,
                        'message' => 'Предмет по таким параметрам не найден....'
                    ];
                    return $output;
                } else {
                    $variant = Variant::findOne(['id_subject' => $template->id]);
                    if (is_null($variant)) {
                        $output = [
                            'success' => false,
                            'message' => 'Вариант по таким параметрам не найден....'
                        ];
                        return $output;
                    } else {
                        $output = [
                            'success' => true,
                            'message' => 'Вариант найден....',
                            'numberVariant' => $variant->number,
                            'idVariant' => $variant->id,
                        ];
                        return $output;
                    }
                }
            }
            if ($_POST['action'] === 'addTest') {
                $userExam = new UserExam();
                $userExam->id_user = $_POST['idUser'];
                $userExam->id_variant = $_POST['variant'];
                if ($userExam->save(false)) {
                    $variant = Variant::findOne(['id' => $userExam->id_variant]);
                    $subjectBlanks = SubjectBlanks::find()
                        ->innerJoin('template_blank', 'template_blank.id_tb = subject_blanks.id_templateblank')
                        ->where(['id_subject' => $variant->id_subject])
                        ->asArray()
                        ->all();
                    foreach ($subjectBlanks as $sB) {
                        $id_tb = $sB['id_templateblank'];
                        $inputs = BlankInputs::find()->where(['blank_id' => $id_tb])->asArray()->all();
                        $result = BlankHelper::ParseValues($inputs);
                        $template = TemplateBlank::findOne(['id_tb' => $id_tb]);
                        $subject = Subject::findOne(['id' => $variant->id_subject]);
                        $params['code'] = $subject->code;
                        $params['subject'] = $subject->name;
                        $params['user_id'] = $_POST['idUser'];
                        $params['variant_id'] = $variant->id;
                        $params['blank_name'] = $template->type_blank;
                        $params['id_exam'] = $userExam->id;
                        $path = $_SERVER['DOCUMENT_ROOT'].'/web/blanks/templates/'.$template->class_templ.'/'.$template->type_test.'/'.$template->type_blank.'/'.$template->image_name;
                        BlankHelper::InsertInBlank($result, $path, $params);
                    }
                    return ['message' => 'Тестирование назначено!'];
                }
                else {
                    return ['message' => 'Произошла ошибка'];
                }
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
