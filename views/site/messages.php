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
    $switch = false;

    foreach ($messages as $message) {

        $switch = !$switch;

        echo Html::beginTag(
            'div',
            ['class' => 'row message-container' . ( ( $switch )? ' even-message':'' )]
        );

        $userName = Html::encode($message->user->name) . ' ( ' . $message->user->email . ' )';

        echo Html::tag('p', Html::tag(
                'span',
                date('d-M-Y H:i:s', $message->created_at)) . ' - ' . $userName,
                [
                    'class' => 'message-header'
                ]
        );

        echo Html::tag(
            'p',
            Html::encode($message->message),
            [
                'class' => 'message-body',
            ]
        );

        echo Html::endTag('div');
    }

    echo LinkPager::widget([
        'pagination' => $pagination,
    ]);
}