<?php

namespace frontend\models\form;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $password;

    public function rules()
    {
        return [
            [['password'], 'required'],
        ];
    }
    public function getDate()
    {
        return $this->date;
    }
    public function genPassword(): string
    {
        return Yii::$app->getSecurity()->generatePasswordHash($this->password);
    }

}