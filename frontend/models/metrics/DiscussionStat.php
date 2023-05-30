<?php

namespace frontend\models\metrics;


class DiscussionStat extends ParentStat
{
    public function __construct($attributes = [])
    {
        parent::__construct($attributes, "discussion");
    }

    public static function collectionName()
    {
        return 'discussion_stat';
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
            [['plan', 'real', 'date'], 'safe']
        ];
    }

    public function getDates()
    {
        $array = $this::find()
            ->orderBy('date')
            ->asArray()
            ->all();

        foreach ($array as $element) {
            $dates[] = date("Y-m-d",$element['date']);
        }

        return $dates;
    }
}