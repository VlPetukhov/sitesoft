<?php
/**
 * Messages
 *
 * @var $this yii\web\View
 * @var $messages array
 * @var $pagination yii\data\Pagination
 */
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