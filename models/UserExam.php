<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_exam".
 *
 * @property int $id
 * @property int $id_variant
 * @property int $id_user
 * @property string $status
 *
 * @property UserTable $user
 * @property Variant $variant
 */
class UserExam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_exam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_variant', 'id_user', 'status'], 'required'],
            [['id_variant', 'id_user'], 'integer'],
            [['status'], 'string'],
            [['id_variant'], 'exist', 'skipOnError' => true, 'targetClass' => Variant::className(), 'targetAttribute' => ['id_variant' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => UserTable::className(), 'targetAttribute' => ['id_user' => 'user_id']],
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
            'id_user' => 'Id User',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserTable::className(), ['user_id' => 'id_user']);
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
