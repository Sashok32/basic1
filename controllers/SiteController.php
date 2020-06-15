<?php

namespace app\controllers;

use app\models\EntryForm;
use foo\Foo;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTest()
    {
        $authManager = Yii::$app->getAuthManager();
//        echo '<pre>';
//        print_r(Yii::getAlias('@app/rbac'));
        print_r($authManager);
        die();


        $session = Yii::$app->session;
        // Запрос #1
// установка flash-сообщения с названием "postDeleted"
        $session->setFlash('postDeleted', 'Вы успешно удалили пост.');
// Запрос #2
// отображение flash-сообщения "postDeleted"
        echo $session->getFlash('postDeleted');

$response['ok'] = true;
        Yii::$app->response->format = Response::FORMAT_JSON;  //test
        return $response;

//        $testTwitter = new \TwitterAPIExchange();
//        $testTwitter = new \TwitterAPIExchangeTest();

//        $testTwitter = $testTwitter->testStatusesMentionsTimeline();


//        Yii::$app->response->content = Yii::$app->language;  //test

//        echo '<pre>';
//        print_r('TestPage');
//        die();
//
//
//        return $this->render('about');
    }

    public function actionEntry()
    {


        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->imgFile = UploadedFile::getInstance($model, 'imgFile');
            if ($model->validate()) {
                $path = Yii::getAlias('@webroot').'/uploads';
                if (!is_dir($path)) {
                    mkdir($path);
                }
                $model->imgFile->saveAs($path . '/'. $model->imgFile->name);
                return $this->render('entry-confirm', ['model' => $model, 'path' => $path . '/'. $model->imgFile->name]);
            } else {
                return $this->render('entry', ['model' => $model]);
            }
        } else {
            return $this->render('entry', ['model' => $model]);
        }
    }
}
