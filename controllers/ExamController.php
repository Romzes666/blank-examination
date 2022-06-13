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
        $subjectBlanks = SubjectBlanks::findOne(['id_subject' => $id_sb]);
        $id_tb = $subjectBlanks->id_templateblank;
        $blank = TemplateBlank::findOne(['id_tb' => $id_tb]);
        $inputs = BlankInputs::find()->where(['blank_id' => $id_tb])->all();
        return $this->render('registration', [
            'blank' => $blank,
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