<?php

use yii\helpers\Url;

/**
 * @var string $subject
 * @var \amnah\yii2\user\models\User $user
 * @var \amnah\yii2\user\models\Profile $profile
 * @var \amnah\yii2\user\models\UserKey $userKey
 */
?>



<p><?= Yii::t("user", "Plesae use following credentials to login in OCM.") ?></p>

<p><?= Url::toRoute(["/user/login"], true); ?></p>

<p>Username: <?=  $username ?></p>

<p>Password: <?=  $password ?></p>