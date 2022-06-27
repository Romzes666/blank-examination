<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_table".
 *
 * @property int $user_id
 * @property string $user_email_address
 * @property string $user_password
 * @property string $user_verfication_code
 * @property string $user_name
 * @property string $last_name
 * @property string $user_image
 * @property string $user_created_on
 * @property string $user_email_verified
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property string $role
 *
 * @property ExamUsers[] $examUsers
 */
class User extends ActiveRecord
{

    const ROLE_USER = 'user';
    const ROLE_EXPERT = 'expert';
    const ROLE_ADMIN = 'admin';
    const STATUS_WAIT = 'no';
    const STATUS_ACTIVE = 'yes';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
              ['user_email_verified', 'in', 'range' => [self::STATUS_WAIT, self::STATUS_ACTIVE]],
              [['user_email_address', 'user_password', 'user_name', 'last_name'], 'required'],
              [['user_email_verified', 'role'], 'string'],
              [['user_email_address'], 'string', 'max' => 250],
              ['user_email_address', 'unique'],
              [['user_password', 'user_name', 'user_image'], 'string', 'max' => 150],
              [['user_verfication_code'], 'string', 'max' => 100],
              [['last_name', 'auth_key', 'access_token'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_email_address' => 'User Email Address',
            'user_password' => 'User Password',
            'user_verfication_code' => 'User Verfication Code',
            'user_name' => 'User Name',
            'last_name' => 'Last Name',
            'user_image' => 'User Image',
            'user_created_on' => 'User Created On',
            'user_email_verified' => 'User Email Verified',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[ExamUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExamUsers()
    {
        return $this->hasMany(ExamUsers::className(), ['user_id' => 'user_id']);
    }

    public static function roles()
    {
        return [
            self::ROLE_USER => Yii::t('app', 'User'),
            self::ROLE_ADMIN => Yii::t('app', 'Admin'),
            self::ROLE_EXPERT => Yii::t('app', 'Expert'),
        ];
    }
    /**
     * Название роли
     * @param int $id
     * @return mixed|null
     */
    public function getRoleName(int $id): mixed
    {
        $list = self::roles();
        return $list[$id] ?? null;
    }

    public function isAdmin(): bool
    {
        return ($this->role == self::ROLE_ADMIN);
    }

    public function isExpert(): bool
    {
        return ($this->role == self::ROLE_EXPERT);
    }

    public function isUser(): bool
    {
        return ($this->role == self::ROLE_USER);
    }
}
