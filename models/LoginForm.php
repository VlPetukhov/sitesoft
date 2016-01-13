<?php
/**
 * @class LoginForm
 * @namespace app\models
 *
 * @property string $email
 * @property string $password
 */

namespace app\models;


use Yii;
use yii\base\Model;

class LoginForm extends Model{
    public $email;
    public $password;

    protected $_user;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['password'], 'passwordValidate'],
        ];
    }

    /**
     * Password validator
     */
    public function passwordValidate()
    {
        if ($this->hasErrors()) {
            return;
        }

        /** @var User $user */
        $user = $this->getUser();

        if ( !$user || !$user->validatePassword($this->password)) {
            $this->addError('password', 'Ошибочный email или пароль');
        }
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ( ! $this->validate() ) {
            return false;
        }

        return Yii::$app->user->login($this->getUser());
    }

    /**
     * @return null|static
     */
    protected function getUser()
    {
        if ( !$this->_user ) {
            $this->_user = User::findOne(['email' => $this->email]);
        }

        return $this->_user;
    }
} 