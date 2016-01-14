<?php
/**
 * Index view
 *
 * @var $this yii\web\View
 * @var $messages array
 * @var $pagination yii\data\Pagination
 * @var $userMessage app\models\MessageForm
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\LinkPager;

if ( empty($messages) ) {
    echo Html::tag('div', 'Нет сообщений');
} else {
    foreach ($messages as $message) {
        echo Html::beginTag('div', ['class' => 'row']);
        $userName = Html::encode($message->user->name) . ' ( ' . $message->user->email . ' )';
        echo Html::tag('p', Html::tag('span', date('d-M-Y H:i:s', $message->created_at)) . ' - ' . $userName);
        echo Html::tag('p', Html::encode($message->message));
        echo Html::endTag('div');
    }

    echo LinkPager::widget([
        'pagination' => $pagination,
    ]);
}

if ( ! Yii::$app->user->isGuest ) :?>
<div class="row">
    <?php $form = ActiveForm::begin()?>
    <?= $form->field($userMessage, 'message')->textarea()?>
    <div class="form-group">
        <?= Html::submitButton(
            'Отправить!',
            [
                'class' => 'btn btn-primary',
                'name' => 'signup-button'
            ]); ?>
    <?php $form->end();?>
</div>
<?php endif;?>