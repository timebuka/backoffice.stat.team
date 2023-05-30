<?php

namespace frontend\models\metrics;

use yii\mongodb\ActiveRecord;

class ParentStat extends ActiveRecord
{
    /**
     * @var mixed|null
     */
    private $name;

    public function __construct($attributes = [], $name = "")
    {
        parent::__construct();
        $this->attributes = $attributes;
        $this->name = $name;
    }

    public static function getDb()
    {
        return \Yii::$app->mongodb;
    }

    public function getResultData()
    {
        $array = $this::find()
            ->orderBy('date')
            ->asArray()
            ->all();

        $keySearch = ['countFailClient', 'countTasksNotСomplete', 'real'];

        $keyFilter = ['_id', 'date', 'description', 'reason'];

        foreach ($array as $element) {
            foreach ($element as $key => $item) {
                if (in_array($key, $keySearch)) {
                    $addKey = ucfirst($key);
                }
                if (!in_array($key, $keyFilter)) {
                    $result[$this->name.ucfirst($key)]['name'] = $this->name.ucfirst($key);
                    $result[$this->name.ucfirst($key)]['data'][$element['date']]['y'] = (float)$item;
                }
            }
            if (isset($element['reason'])) {
                foreach ($element['reason'] as $value) {
                    if (isset($value['_id'])) {
                        $tag = Tags::findOne(['_id' => $value['_id']]);
                        $result[$this->name.$addKey]['data'][$element['date']]['description'] =
                            isset($result[$this->name.$addKey]['data'][$element['date']]['description']) ?
                                $result[$this->name.$addKey]['data'][$element['date']]['description'] . ", " . $tag->name :
                                "- Причины: ".$tag->name;
                    }
                }
            }
            if (!empty($element['description'])) {
                $result[$this->name.$addKey]['data'][$element['date']]['description'] =
                    isset($result[$this->name.$addKey]['data'][$element['date']]['description']) ?
                        $result[$this->name.$addKey]['data'][$element['date']]['description']."<br/> - Заметка: ".$element['description'] :
                        "- Заметка: ".$element['description'];
            }
        }

        foreach ($result as &$element) {
            $element['data'] = array_values($element['data']);
        }

        return array_values($result);
    }
}