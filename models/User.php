<?php
/**
 * @class User
 * @namespace app\models
 *
 * @property integer $id
 * @property string  $email
 * @property string  $name
 * @property string  $password_hash
 * @property string  $auth_key
 * @property integer $created_at
 *
 * @property string  $password
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface {

    /****************************
     * Interface implementation *
     ****************************/

    /**
     * @param int $id
     * @return void|IdentityInterface
     */
    public static function findIdentity( $id )
    {
        return static::findOne($id);
    }

    /**
     * @return int|void
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void|IdentityInterface
     */
    public static function findIdentityByAccessToken( $token, $type = null )
    {
        //this option is unused in current project
        return null;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey( $authKey )
    {
        return $this->auth_key === $authKey;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return Yii::$app->security->generateRandomString();
    }

    /*******************************
     * ActiveRecord implementation *
     *******************************/

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email', 'name'], 'required', 'on' => 'create'],

            [['email'], 'string', 'max' => 255, 'on' => ['create', 'update']],
            [['email'], 'email', 'on' => ['create', 'update']],
            [['email'], 'unique' ],

            [['name'], 'string', 'max' => 45, 'on' => ['create', 'update']],
            [['name'], 'match', 'pattern' => '/^[a-z0-9 .,_=~!@#$-]+$/i', 'on' => ['create', 'update']],
        ];
    }

    /**
     * Generates password hash
     * @param $password
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function setPassword( $password )
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @param $password
     *
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function validatePassword( $password )
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'email'           => 'Email',
            'name'            => 'Имя пользователя',
            'password'        => 'Пароль',
            'auth_key'        => 'Ключ авторизации',
            'created_at'      => 'Дата регистрации',
        ];
    }

    /**
     * @param bool $insert
     * @return bool|void
     */
    public function beforeSave( $insert )
    {
        if ( ! parent::beforeSave($insert) ) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->auth_key = $this->getAuthKey();
            $this->created_at = time();
        }

        return true;
    }
}