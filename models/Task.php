<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $id_subject
 * @property string $content
 * @property string $symbols
 * @property string $type
 * @property int $max_score
 * @property string $type_check
 *
 * @property Answers[] $answers
 * @property BlankInputs[] $blankInputs
 * @property Subject $subject
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_subject', 'content', 'symbols', 'type', 'max_score'], 'required'],
            [['id_subject', 'max_score'], 'integer'],
            [['content'], 'string', 'max' => 10],
            [['symbols'], 'string', 'max' => 255],
            [['type', 'type_check'], 'string', 'max' => 50],
            [['id_subject'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['id_subject' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_subject' => 'Id Subject',
            'content' => 'Content',
            'symbols' => 'Symbols',
            'type' => 'Type',
            'max_score' => 'Max Score',
            'type_check' => 'Type Check',
        ];
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['id_task' => 'id']);
    }

    /**
     * Gets query for [[BlankInputs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlankInputs()
    {
        return $this->hasMany(BlankInputs::className(), ['task_id' => 'id']);
    }

    /**
     * Save Task values.
     *
     * @param $subject_id
     * @return bool
     */
    public static function saveTask($subject_id)  : bool
    {
        for ($i = 0; $i < $_POST['Subject']['count_task']; $i++) {
            $task = new Task();
            $task->id_subject = $subject_id;
            $task->content = $_POST['description'][$i];
            $task->symbols = $_POST['symbols'][$i];
            $task->max_score = $_POST['score'][$i];
            $task->type = $_POST['type_answer'][$i];
            if($task->type === "Краткий ответ") {
                $task->type_check = $_POST['type_check'][$i];
                if ($task->save()) {
                    $id_task = $task->id;
                    if ($task->type_check !== "Полное совпадение") {
                        foreach ($_POST['error'] as $err) {
                            $errors = new Errors();
                            $errors->id_task = $id_task;
                            $errors->score_error = $err;
                            if ($errors->save()) {
                                continue;
                            }
                            return false;
                        }
                    }
                    continue;
                }
                return false;
            }
            else {
                if ($task->save()) {
                    continue;
                }
                return false;
            }
        }
        return true;
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'id_subject']);
    }
}
