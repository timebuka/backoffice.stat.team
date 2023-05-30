<?php


namespace frontend\models\metrics;


class ReleasesStat extends ParentStat
{
    public function __construct($attributes = [])
    {
        parent::__construct($attributes, "releases");
    }

    public static function collectionName()
    {
        return 'releases_stat';
    }

    public function attributes()
    {
        return ['_id', 'date', 'plan', 'real', 'reason', 'description'];
    }

    public function rules()
    {
        return [
            [['date', 'plan', 'real'], 'required'],
            [['plan', 'real'], 'number'],
            [['description'], 'string'],
            [['reason', 'date'], 'safe']
        ];
    }
}