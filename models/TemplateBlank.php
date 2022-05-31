<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "template_blank".
 *
 * @property int $id_tb
 * @property string $type_blank
 * @property int|null $input_count
 * @property string $image_name
 * @property int $class_templ
 * @property string $type_test
 *
 * @property BlankInputs[] $blankInputs
 * @property SubjectBlanks[] $subjectBlanks
 */
class TemplateBlank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template_blank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_blank', 'image_name', 'class_templ', 'type_test'], 'required'],
            [['input_count', 'class_templ'], 'integer'],
            [['type_blank'], 'string', 'max' => 50],
            [['image_name'], 'string', 'max' => 255],
            [['type_test'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tb' => 'ID',
            'type_blank' => 'Тип бланка',
            'input_count' => 'Количество полей',
            'image_name' => 'Image Name',
            'class_templ' => 'Номер класса',
            'type_test' => 'Тип тестирования',
        ];
    }

    /**
     * Gets query for [[BlankInputs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlankInputs()
    {
        return $this->hasMany(BlankInputs::className(), ['blank_id' => 'id_tb']);
    }

    /**
     * Gets query for [[SubjectBlanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectBlanks()
    {
        return $this->hasMany(SubjectBlanks::className(), ['id_templateblank' => 'id_tb']);
    }
}
