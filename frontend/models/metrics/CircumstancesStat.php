<?php


namespace frontend\models\metrics;


class CircumstancesStat extends ParentStat
{
    public function __construct($attributes = [])
    {
        parent::__construct($attributes, "circumstances");
    }

    public static function collectionName()
    {
        return 'circumstances_stat';
    }

    public function attributes()
    {
        return ['_id', 'date', 'countUrgentTasks', 'countFailServer', 'countFailClient', 'description', 'reason'];
    }

    public function rules()
    {
        return [
            [['date', 'countUrgentTasks', 'countFailServer', 'countFailClient'], 'required'],
            [['countUrgentTasks', 'countFailServer', 'countFailClient'], 'integer'],
            [['description'], 'string'],
            [['reason', 'date'], 'safe']
        ];
    }
}