<?php


namespace frontend\models\metrics;


class TestCasesStat extends ParentStat
{
    public function __construct($attributes = [])
    {
        parent::__construct($attributes, "testCases");
    }

    public static function collectionName()
    {
        return 'test_cases_stat';
    }

    public function attributes()
    {
        return ['_id', 'date', 'tookTasks', 'countTasksСomplete', 'countTasksNotСomplete',
            'reason', 'description'];
    }

    public function rules()
    {
        return [
            [['date', 'tookTasks', 'countTasksСomplete', 'countTasksNotСomplete'], 'required'],
            [['tookTasks', 'countTasksNotСomplete', 'countTasksСomplete'], 'number'],
            [['description'], 'string'],
            [['reason', 'date'], 'safe']
        ];
    }
}