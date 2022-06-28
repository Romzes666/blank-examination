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
 * @property User $user
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
            [['id_variant'], 'exist', 'skipOnError' => true, 'targetClass' => Variant::class, 'targetAttribute' => ['id_variant' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_variant' => 'Вариант',
            'id_user' => 'Пользователь',
            'status' => 'Статус',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['user_id' => 'id_user']);
    }

    /**
     * Gets query for [[Variant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariant()
    {
        return $this->hasOne(Variant::class, ['id' => 'id_variant']);
    }
}
