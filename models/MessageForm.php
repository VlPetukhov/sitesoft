<?php
/**
 * @class MessageForm
 * @namespace app\models
 */

namespace app\models;


use Yii;
use yii\base\Model;

class MessageForm extends Model{
    public $message;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['message'], 'required'],
            [['message'], 'string'],
            [['message'], 'match', 'pattern' => '/^[\S|\s]+[\S][\S|\s]*$/i'],
        ];
    }

    /**
     * @return Message|null
     */
    public function process()
    {
        if ( ! $this->validate() || Yii::$app->user->isGuest) {
            return null;
        }

        $message = new Message(['scenario' => 'create']);

        $message->message = $this->message;
        $message->user_id = Yii::$app->user->id;

        if ($message->save()) {
            return $message;
        }

        return null;
    }
} 