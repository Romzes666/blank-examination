<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blank_inputs".
 *
 * @property int $id
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
            [['input_width', 'input_height', 'input_top', 'input_left'], 'string'],
            ['blank_id', 'integer'],
            [['blank_id', 'input_width', 'input_height', 'input_top', 'input_left', 'input_tooltip'], 'required'],
            [['input_tooltip'], 'string', 'max' => 255],
            [['blank_id'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateBlank::class, 'targetAttribute' => ['blank_id' => 'id_tb']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
        return $this->hasOne(TemplateBlank::className(), ['id_tb' => 'blank_id']);
    }

    public static function saveBlankInputs($blankId) : bool
    {
        $len = $_POST['width'];
        for ($i = 0; $i < count($len); $i++) {
            $inputs = new BlankInputs();
            $inputs->input_height = $_POST['height'][$i];
            $inputs->input_width = $_POST['width'][$i];
            $inputs->input_left = $_POST['left'][$i];
            $inputs->input_top = $_POST['top'][$i];
            $inputs->input_tooltip = $_POST['title'][$i];
            $inputs->blank_id = $blankId;
            if ($inputs->save(false)) {
                continue;
            }
            return false;
        }
        return true;
    }
}
