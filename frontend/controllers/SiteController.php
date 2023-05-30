<?php
namespace frontend\controllers;


use frontend\models\auth\LoginForm;
use frontend\presenters\LoginPresenter;
use frontend\services\LoginService;
use frontend\presenters\StatPresenter;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private StatPresenter $statPresenter;
    private LoginPresenter $loginPresenter;
    private LoginForm $modelLoginForm;
    private LoginService $loginService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->loginPresenter = new LoginPresenter();
        $this->statPresenter = new StatPresenter();
        $this->modelLoginForm = new LoginForm();
        $this->loginService = new LoginService();
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'crypt', 'gen-crypt', 'authentication'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
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
     * @return Response
     */
    public function actionIndex()
    {
        return $this->redirect(['view-charts']);
    }

    public function actionViewCharts()
    {
        return $this->render('viewСharts');
    }

    public function actionGetArrayOutput()
    {
        return $this->statPresenter->getArrayOutput();
    }

    public function actionGetDatesOutput()
    {
        return $this->statPresenter->getDatesOutput();
    }

    public function actionTagsControl()
    {
        return $this->statPresenter->renderTags();
    }

    public function actionEditTag($id)
    {
        return $this->statPresenter->renderTagEditTab($id);
    }

    public function actionAddTag()
    {
        return $this->statPresenter->getNewTag();
    }

    public function actionSaveTag()
    {
        return $this->statPresenter->getResultSaveTag();
    }

    public function actionSaveEntry()
    {
        return $this->statPresenter->getResultSave();
    }

    public function actionEntry()
    {
        return $this->statPresenter->renderEntry();
    }

    public function actionCrypt(): string
    {
        return $this->loginPresenter->renderCryptPage();
    }

    public function actionGenCrypt(): string
    {
        return $this->loginPresenter->renderGenCrypt();
    }

    public function actionAuthentication()
    {
        $authentication = $this->loginService->authentication();

        if ($authentication === true) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $authentication,
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('login', [
            'model' => $this->modelLoginForm,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
