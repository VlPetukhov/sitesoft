<?php
/**
 * Index view
 *
 * @var $this yii\web\View
 * @var $userMessage app\models\MessageForm
 * @var $messages array
 * @var $pagination yii\data\Pagination
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

\app\assets\RoutineAsset::register($this);
?>
<div class="messages">
<?= $this->render('messages',
    [
        'messages' => $messages,
        'pagination' => $pagination
    ]
);?>
</div>
<?php if ( ! Yii::$app->user->isGuest ) :?>
<div class="row">
    <?php $form = ActiveForm::begin([
        'enableClientScript' => false,
    ])?>
    <?= $form->field($userMessage, 'message')->textarea()?>
    <div class="form-group">
        <?= Html::submitButton(
            'Отправить!',
            [
                'class' => 'btn btn-primary',
                'name' => 'signup-button'
            ]); ?>
    </div>
    <?php $form->end();?>
</div>
<?php endif;?>