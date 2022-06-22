<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "variant_blank".
 *
 * @property int $id
 * @property int $id_exam
 * @property string $prefix
 * @property string $name
 *
 * @property UserExam $exam
 */
class VariantBlank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variant_blank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_exam', 'prefix', 'name'], 'required'],
            [['id_exam'], 'integer'],
            [['prefix'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['id_exam'], 'exist', 'skipOnError' => true, 'targetClass' => UserExam::className(), 'targetAttribute' => ['id_exam' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_exam' => 'Id Exam',
            'prefix' => 'Prefix',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Exam]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExam()
    {
        return $this->hasOne(UserExam::className(), ['id' => 'id_exam']);
    }
}
