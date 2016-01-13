<?php
/**
 * @class SiteController
 * @namespace app\controllers
 */

namespace app\controllers;


use app\models\LoginForm;
use app\models\SignUpForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller {

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login', 'signup', 'post'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => ['logout', 'post'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {
        $model = new SignUpForm();

        if ($model->load(Yii::$app->request->post()) && $model->signUp()) {
            return $this->goHome();
        }

        return $this->render( 'signup',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * @return string
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->goHome();
        }

        return $this->render('login',
            [
                'model' => $model,
            ]);
    }

    /**
     *
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        $this->goHome();
    }
} 