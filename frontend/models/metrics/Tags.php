<?php

namespace frontend\models\metrics;

use yii\mongodb\ActiveRecord;


class Tags extends ActiveRecord
{
    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public static function collectionName()
    {
        return 'tags';
    }

    public static function getDb()
    {
        return \Yii::$app->mongodb;
    }

    public function attributes()
    {
        return ['_id', 'name', 'color'];
    }

    public function rules()
    {
        return [
            [[ 'name'], 'required'],
            [['name', 'color'], 'string']
        ];
    }
}