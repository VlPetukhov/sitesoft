<?php
/**
 * @class SignUpForm
 * @namespace app\models
 *
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $password_repeat
 */

namespace app\models;


use yii\base\Model;

class SignUpForm extends Model {

    //Properties
    public $name;
    public $email;
    public $password;
    public $password_repeat;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email', 'name', 'password'], 'required'],

            [['email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User'],

            [['name'], 'string', 'max' => 45],
            [['name'], 'match', 'pattern' => '/^[a-z0-9 .,_=~!@#$-]+$/i'],

            [['password', 'password_repeat'], 'string', 'min' => 3],
            [['password'], 'compare'],
            [['password'], 'match', 'pattern' => '/^[a-z0-9_~!@#$-]{3,}$/i'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'email'           => 'Email',
            'name'            => 'Имя пользователя',
            'password'        => 'Пароль',
            'password_repeat' => 'Повтор пароля',
        ];
    }

    /**
     * @return User|null
     */
    public function signUp()
    {
        if ( ! $this->validate() ) {
            return null;
        }

        $user = new User(['scenario' => 'create']);

        $user->email = $this->email;
        $user->name = $this->name;
        $user->password = $this->password;

        if ( $user->save() ) {
            return $user;
        }

        return null;
    }
} 