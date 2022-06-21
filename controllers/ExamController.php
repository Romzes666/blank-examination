<?php


namespace app\controllers;


use app\helpers\BlankHelper;
use app\models\BlankInputs;
use app\models\Subject;
use app\models\SubjectBlanks;
use app\models\TemplateBlank;
use app\models\UserExam;
use app\models\UserExamSearch;
use app\models\Variant;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ExamController extends Controller
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
                ],
            ]
        );
    }

    public function actionIndex(): string
    {
        $searchModel = new UserExamSearch();
        $dataProvider = $searchModel->searchByID($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegistration($id_sb): string
    {
        $variant = Variant::findOne(['id' => $id_sb]);
        $subjectBlanks = SubjectBlanks::find()->innerJoin('template_blank', 'template_blank.id_tb = subject_blanks.id_templateblank')
            ->where(['id_subject' => $variant->id_subject, 'type_blank' => 'Бланк регистрации'])->asArray()->all();
        $id_tb = $subjectBlanks[0]['id_templateblank'];
        $inputs = BlankInputs::find()->where(['blank_id' => $id_tb])->asArray()->all();
        $result = BlankHelper::ParseValues($inputs);
        $template = TemplateBlank::findOne(['id_tb' => $id_tb]);
        $subject = Subject::findOne(['id' => $variant->id_subject]);
        $params['code'] = $subject->code;
        $params['subject'] = $subject->name;
        $params['user_id'] = \Yii::$app->user->id;
        $params['variant_id'] = $variant->id;
        $params['blank_name'] = $template->type_blank;
        $exam = UserExam::findOne(['id_user' => $params['user_id'], 'id_variant' => $params['variant_id']]);
        $params['id_exam'] = $exam->id;
        $path = $_SERVER['DOCUMENT_ROOT'].'/web/blanks/templates/'.$template->class_templ.'/'.$template->type_test.'/'.$template->type_blank.'/'.$template->image_name;
        BlankHelper::InsertInBlank($result, $path, $params);
        $path = '/web/blanks/'.$params['user_id'].'/'.$params['variant_id'].'/'.$params['blank_name'].'.jpg';
        return $this->render('registration', [
            'blank' => $variant,
            'inputs' => $inputs,
            'path' => $path,
        ]);
    }

    public function actionTest($id)
    {
        $variant = Variant::findOne(['id' => $id]);
        return $this->render('test', [
            'variant' => $variant,
        ]);
    }

    public function actionSave()
    {
        define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/web/upload/user/blank/');
        $img = $_POST['imgBase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . uniqid() . '.png';
        $success = file_put_contents($file, $data);
        print $success ? $file : 'Unable to save the file.';
    }

    public function actionAnswers($id, $id_v)
    {
        $variant = Variant::findOne(['id' => $id]);
        $subjectBlank = (new \yii\db\Query())->from('template_blank')->select(['template_blank.*'])
        ->innerJoin('subject_blanks','`template_blank`.`id_tb` = `subject_blanks`.`id_templateblank`')
        ->innerJoin('subject', '`subject`.`id` = `subject_blanks`.`id_subject`')
        ->where(['subject_blanks.id_subject' => $id])
        ->where(['like', 'type_blank', '%ответ%', false])
        ->all();
        $result = [];
        foreach ($subjectBlank as $blank) {
            if ($blank['type_blank'] == 'Бланк ответов №1') {
                $result = $blank;
            }
        }
        $inputs = BlankInputs::find()->where(['blank_id' => $result['id_tb']])->all();
        return $this->render('answers', [
            'blank' => $variant,
            'inputs' => $inputs,
            'blanks' => $subjectBlank,
        ]);
    }
}