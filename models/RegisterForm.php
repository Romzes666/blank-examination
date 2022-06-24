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
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $image;

    public function rules()
    {
        return [
            // firstName, lastName, mail and password are both required
            [['email', 'firstName', 'lastName', 'password'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstName' => 'Имя',
            'lastName' => 'Фамилия',
            'password' => 'Пароль',
        ];
    }
}