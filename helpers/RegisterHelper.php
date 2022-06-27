<?php

namespace app\helpers;

use app\models\UserIdentity;
use Yii;
use app\models\User;
use app\models\RegisterForm;
use yii\web\UploadedFile;

class RegisterHelper
{

    public function register(RegisterForm $model): User
    {
        $user = new User();
        $user->user_name = $model->userFirstName;
        $user->last_name = $model->userLastName;
        $user->user_email_address = $model->userEmail;
        $user->user_password = md5($model->userPassword);
        $image = UploadedFile::getInstance($model, 'userImage');
        if (!is_null($image)) {
            $new_name = md5($image->baseName) .'.'.$image->extension;
            $path = \Yii::$app->basePath . '/web/upload/images/'. $new_name;
            $image->saveAs($path);
            $user->user_image = $new_name;
        }
        else {
            $user->user_image = 'default.jpg';
        }
        $user->user_verfication_code = md5(Yii::$app->security->generateRandomString());
        $user->user_email_verified = User::STATUS_WAIT;
        if(!$user->save()){
            throw new \RuntimeException('Saving error.');
        }
        return $user;
    }

    public function sentEmailConfirm(User $user)
    {
        $email = $user->user_email_address;

        $sent = Yii::$app->mailer
          ->compose(
            ['html' => 'user-register-confirm-html'],
            ['user' => $user])
          ->setTo($email)
          ->setFrom('Za1tSsss@yandex.ru')
          ->setSubject('Подтверждение регистрации')
          ->send();

        if (!$sent) {
            throw new \RuntimeException('Ошибка отправки.');
        }
    }

    public function confirmation($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }

        $user = UserIdentity::findOne(['user_verfication_code' => $token]);
        if (!$user) {
            throw new \DomainException('User is not found.');
        }

        $user->user_email_verified = User::STATUS_ACTIVE;
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }

        if (!Yii::$app->getUser()->login($user)){
            throw new \RuntimeException('Error authentication.');
        }
    }
}
