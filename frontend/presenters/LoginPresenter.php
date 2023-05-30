<?php

namespace frontend\presenters;

use frontend\models\form\EntryForm;
use Yii;

class LoginPresenter
{
    private EntryForm $formHashPassword;

    public function __construct()
    {
        $this->formHashPassword = new EntryForm();
    }

    public function renderGenCrypt(): string
    {
        $this->formHashPassword->load(Yii::$app->request->post());
        return $this->formHashPassword->genPassword();
    }

    public function renderCryptPage(): string
    {
        return Yii::$app->controller->render('crypt', [
            'model' => $this->formHashPassword,
        ]);
    }
}