<?php

namespace frontend\models\metrics;


class DevelopmentStat extends ParentStat
{
    public function __construct($attributes = [])
    {
        parent::__construct($attributes, "development");
    }

    public static function collectionName()
    {
        return 'development_stat';
    }

    public function attributes()
    {
        return [
            '_id', 'date', 'tookTasks', 'countTasksСomplete',
            'countTasksNotСomplete', 'reason', 'description'
        ];
    }

    public function rules()
    {
        return [
            [['date', 'tookTasks', 'countTasksСomplete', 'countTasksNotСomplete'], 'required'],
            [['tookTasks','countTasksСomplete', 'countTasksNotСomplete'], 'number'],
            [['description'], 'string'],
            [['reason', 'date'], 'safe']
        ];
    }
}