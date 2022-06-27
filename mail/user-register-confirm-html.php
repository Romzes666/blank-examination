<?php
use yii\helpers\Html;

/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/register-confirm', 'token' => $user->user_verfication_code]);
?>
<div class="password-reset">
    <p>Привет <?= Html::encode($user->user_name) ?>,</p>

    <p>Для подтверждения почты необходимо пройти по этой ссылке:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>