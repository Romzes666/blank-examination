<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "template_blank".
 *
 * @property int $id
 * @property int $id_subject
 * @property string $type
 * @property int|null $input_count
 * @property string $image_name
 *
 * @property BlankInputs[] $blankInputs
 * @property Subject $subject
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
            [['id_subject', 'type', 'image_name'], 'required'],
            [['id_subject', 'input_count'], 'integer'],
            [['type'], 'string', 'max' => 50],
            [['image_name'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'input_count' => 'Input Count',
            'image_name' => 'Image Name',
            'subject.name' => 'Name subject'
        ];
    }

    /**
     * Gets query for [[BlankInputs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlankInputs()
    {
        return $this->hasMany(BlankInputs::className(), ['blank_id' => 'id']);
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
    public function getName()
    {
        return $this->subject->name;
    }
}
