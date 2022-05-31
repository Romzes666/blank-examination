<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject_blanks".
 *
 * @property int $id_sb
 * @property int $id_subject
 * @property int $id_templateblank
 *
 * @property Subject $subject
 * @property TemplateBlank $templateblank
 */
class SubjectBlanks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject_blanks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_subject', 'id_templateblank'], 'required'],
            [['id_subject', 'id_templateblank'], 'integer'],
            ['id_subject', 'unique', 'targetAttribute' => ['id_subject', 'id_templateblank']],
            [['id_templateblank'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateBlank::className(), 'targetAttribute' => ['id_templateblank' => 'id_tb']],
            [['id_subject'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['id_subject' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sb' => 'Id Sb',
            'id_subject' => 'Id Subject',
            'id_templateblank' => 'Id Templateblank',
        ];
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

    /**
     * Gets query for [[Templateblank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateblank()
    {
        return $this->hasOne(TemplateBlank::className(), ['id_tb' => 'id_templateblank']);
    }
}
