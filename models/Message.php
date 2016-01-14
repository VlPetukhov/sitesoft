<?php
/**
 * @class Message
 * @namespace app\models
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $message
 * @property integer $created_at
 */

namespace app\models;


use yii\data\Pagination;
use yii\db\ActiveRecord;

class Message extends ActiveRecord{

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['user_id', 'message'], 'required', 'on' => ['create','update']],
            [['user_id'], 'integer', 'on' => ['create','update']],
            [['message'], 'string', 'on' => ['create','update']],
            [['message'], 'match', 'pattern' => '/^[\S|\s]+[\S][\S|\s]*$/i', 'on' => ['create','update']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'user_id'])->inverseOf('messages');
    }

    /**
     * @param bool $insert
     *
     * @return bool
     */
    public function beforeSave( $insert )
    {
        if ( ! parent::beforeSave($insert) ) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at = time();
        }

        return true;
    }
}