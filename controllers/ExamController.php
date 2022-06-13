<?php


namespace app\controllers;


use app\models\BlankInputs;
use app\models\SubjectBlanks;
use app\models\TemplateBlank;
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

    public function actionIndex()
    {
        $searchModel = new UserExamSearch();
        $dataProvider = $searchModel->searchByID($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegistration($id_sb)
    {
        $variant = Variant::findOne(['id' => $id_sb]);
        $subjectBlanks = SubjectBlanks::findOne(['id_subject' => $id_sb]);
        $id_tb = $subjectBlanks->id_templateblank;
        $inputs = BlankInputs::find()->where(['blank_id' => $id_tb])->all();
        return $this->render('registration', [
            'blank' => $variant,
            'inputs' => $inputs,
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
        $subjectBlank = (new \yii\db\Query())->from('template_blank')->select(['template_blank.*'])
        ->innerJoin('subject_blanks','`template_blank`.`id_tb` = `subject_blanks`.`id_templateblank`')
        ->innerJoin('subject', '`subject`.`id` = `subject_blanks`.`id_subject`')
        ->where(['subject_blanks.id_subject' => $id])
        ->all();
        $result = [];
        foreach ($subjectBlank as $blank) {
            if ($blank['type_blank'] == 'Бланк ответов №1') {
                $result = $blank;
            }
        }
        $inputs = BlankInputs::find()->where(['blank_id' => $result['id_tb']])->all();
        return $this->render('answers', [
            'blank' => $result,
            'inputs' => $inputs
        ]);
    }
}