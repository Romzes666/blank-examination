<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Register Form is the model behind the register form.
 *
 * @property-read UserIdentity|null $user
 *
 */

class RegisterForm extends Model
{
    public $userFirstName;
    public $userLastName;
    public $userEmail;
    public $userPassword;
    public $userImage;

    public function rules()
    {
        return [
            // firstName, lastName, mail and password are both required
            [['userEmail', 'userFirstName', 'userLastName', 'userPassword'], 'required'],
            ['userEmail', 'filter', 'filter' => 'trim'],
            ['userEmail', 'email'],
            ['userEmail', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'user_email_address',
              'message' => 'Такая почта уже зарегестрирована.'],
            [['userFirstName'], 'string', 'min' => 2, 'max' => 50],
            [['userLastName'], 'string',  'max' => 50],
            [['userPassword'], 'string', 'min' => 6],
            [['userImage'], 'file', 'extensions' => ['png', 'jpg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'userFirstName' => 'Имя',
            'userLastName' => 'Фамилия',
            'userPassword' => 'Пароль',
            'userEmail' => 'Email',
            'userImage' => 'Изображение',
        ];
    }

}