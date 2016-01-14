<?php
/**
 * @class SiteController
 * @namespace app\controllers
 */

namespace app\controllers;


use app\models\LoginForm;
use app\models\Message;
use app\models\MessageForm;
use app\models\SignUpForm;
use Yii;
use yii\data\Pagination;
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
        $query = Message::find()->orderBy(['created_at' => SORT_DESC]);

        $count = $query->count();

        $pagination = new Pagination(
            [
                'totalCount' => $count,
                'pageSize' => 25,
            ]
        );

        $messages = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $userMessage = new MessageForm();

        if ($userMessage->load(Yii::$app->request->post()) && $userMessage->process()) {
            $this->redirect(['index']);
        }

        return $this->render('index',
            [
                'messages' => $messages,
                'pagination' => $pagination,
                'userMessage' => $userMessage,

            ]);
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