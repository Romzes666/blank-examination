<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property int $id_variant
 * @property string $answer
 * @property int $score
 * @property int $diff_score
 * @property int $id_task
 *
 * @property Task $task
 * @property Variant $variant
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_variant', 'answer', 'score', 'diff_score', 'id_task'], 'required'],
            [['id_variant', 'score', 'diff_score', 'id_task'], 'integer'],
            [['answer'], 'string', 'max' => 255],
            [['id_variant'], 'exist', 'skipOnError' => true, 'targetClass' => Variant::className(), 'targetAttribute' => ['id_variant' => 'id']],
            [['id_task'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['id_task' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_variant' => 'Id Variant',
            'answer' => 'Answer',
            'score' => 'Score',
            'diff_score' => 'Diff Score',
            'id_task' => 'Id Task',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'id_task']);
    }

    /**
     * Gets query for [[Variant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariant()
    {
        return $this->hasOne(Variant::className(), ['id' => 'id_variant']);
    }
}
