<?php
/**
 * Right sidebar
 *
 * @var $this yii\web\View
 */

use yii\bootstrap\Html;
use yii\helpers\Url;

if ( Yii::$app->user->isGuest ) {
    return Html::tag('p', 'Авторизируйтесь!');
}
/** @var app\models\User $user */
$user = Yii::$app->user->identity;
?>
<div class="right-sidebar">
    <p class="user-info">
        <?=$user->name; ?>
        <br />
        <span class="user-email"><?= $user->email?></span>
    </p>
    <a href="<?= Url::to(['logout']);?>" class="btn btn-default">Выйти</a>
</div>