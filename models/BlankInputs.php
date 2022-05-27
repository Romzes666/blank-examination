<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blank_inputs".
 *
 * @property int $id
 * @property int|null $task_id
 * @property int $blank_id
 * @property int $input_width
 * @property int $input_height
 * @property int $input_top
 * @property int $input_left
 * @property string $input_tooltip
 *
 * @property TemplateBlank $blank
 * @property Task $task
 */
class BlankInputs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blank_inputs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'blank_id', 'input_width', 'input_height', 'input_top', 'input_left'], 'integer'],
            [['blank_id', 'input_width', 'input_height', 'input_top', 'input_left', 'input_tooltip'], 'required'],
            [['input_tooltip'], 'string', 'max' => 255],
            [['blank_id'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateBlank::className(), 'targetAttribute' => ['blank_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'blank_id' => 'Blank ID',
            'input_width' => 'Input Width',
            'input_height' => 'Input Height',
            'input_top' => 'Input Top',
            'input_left' => 'Input Left',
            'input_tooltip' => 'Input Tooltip',
        ];
    }

    /**
     * Gets query for [[Blank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlank()
    {
        return $this->hasOne(TemplateBlank::className(), ['id' => 'blank_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
