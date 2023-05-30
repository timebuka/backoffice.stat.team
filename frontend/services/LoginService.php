<?php

namespace frontend\services;

use frontend\models\auth\LoginForm;
use Yii;

class LoginService
{
    public function authentication()
    {
        $modelLoginForm = new LoginForm();
        if ($modelLoginForm->load(Yii::$app->request->post()) && $modelLoginForm->login()) {
            return true;
        } else {
            return $modelLoginForm->password = '';
        }
    }
}