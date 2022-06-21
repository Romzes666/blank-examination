<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string $name
 * @property int $class
 * @property string $type
 * @property int $count_task
 * @property string $code
 *
 * @property SubjectBlanks[] $subjectBlanks
 * @property Task[] $tasks
 * @property Variant[] $variants
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'class', 'type', 'count_task', 'code'], 'required'],
            [['class', 'count_task'], 'integer'],
            [['name', 'type'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'class' => 'Class',
            'type' => 'Type',
            'count_task' => 'Count Task',
            'code' => 'Code',
        ];
    }

    /**
     * Gets query for [[SubjectBlanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectBlanks()
    {
        return $this->hasMany(SubjectBlanks::className(), ['id_subject' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['id_subject' => 'id']);
    }

    /**
     * Gets query for [[Variants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariants()
    {
        return $this->hasMany(Variant::className(), ['id_subject' => 'id']);
    }
}
