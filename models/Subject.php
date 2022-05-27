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
 *
 * @property Task[] $tasks
 * @property TemplateBlank[] $templateBlanks
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
            [['name', 'class', 'type', 'count_task'], 'required'],
            ['name', 'unique', 'targetAttribute' => ['name', 'type']],
            [['class', 'count_task'], 'integer'],
            [['name', 'type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'class' => 'Класс',
            'type' => 'Тип тестирования',
            'count_task' => 'Количество заданий',
        ];
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
     * Gets query for [[TemplateBlanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateBlanks()
    {
        return $this->hasMany(TemplateBlank::className(), ['id_subject' => 'id']);
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
