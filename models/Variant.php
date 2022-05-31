<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "variant".
 *
 * @property int $id
 * @property int $id_subject
 * @property string $number
 * @property string $kim
 * @property int $count_list
 *
 * @property Answers[] $answers
 * @property Subject $subject
 * @property UserExam[] $userExams
 */
class Variant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_subject', 'number', 'kim', 'count_list'], 'required'],
            [['id_subject', 'count_list'], 'integer'],
            [['number'], 'string', 'max' => 50],
            [['kim'], 'string', 'max' => 100],
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
            'number' => 'Вариант',
            'kim' => 'КИМ',
            'count_list' => 'Кол-во страниц',
        ];
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['id_variant' => 'id']);
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
     * Gets query for [[UserExams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserExams()
    {
        return $this->hasMany(UserExam::className(), ['id_variant' => 'id']);
    }
}
