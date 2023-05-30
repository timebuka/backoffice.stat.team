<?php

namespace frontend\services;

use frontend\models\metrics\DiscussionStat;
use frontend\models\metrics\Tags;
use MongoDB\BSON\ObjectId;
use Yii;

class ManipulationModelsService
{
    private DataService $dateService;

    public function __construct()
    {
        $this->dateService = new DataService();
    }

    /**
     * Загрузка всех моделей.
     *
     * @return array
     */
    public function loadModels(): array
    {
        $arrayModels = ['discussion', 'releases', 'development', 'testing', 'testCases', 'circumstances'];

        foreach ($arrayModels as $model) {
            $className = "frontend\models\metrics\\" . ucfirst($model) . "Stat";
            $models[$model] = new $className();
        }

        return $models;
    }

    /**
     * @param $post
     * @return bool
     */
    public function saveInfoIteration($post): bool
    {
        $models = $this->loadModels();
        extract($models);

        $arrayModels = ['discussion', 'releases', 'development', 'testing', 'testCases', 'circumstances'];

        if (
            $discussion->load($post) && $releases->load($post) &&
            $development->load($post) && $testing->load($post) &&
            $testCases->load($post) && $circumstances->load($post)
        ) {
            $result = $this->dateService->checkDateWeek($discussion->date);
            if (!$result) {
                return false;
            }
            $date = $discussion->date;

            foreach ($arrayModels as $model) {

                ${$model}->date = strtotime($date);

                $arrayReason = [];
                if (!empty(${$model}->reason)) {
                    foreach (${$model}->reason as $id => $element) {
                        $arrayReason[]['_id'] = new ObjectId($element);
                    }
                }
                ${$model}->reason = $arrayReason;
                ${$model}->save();
            }
        } else {
            $result = false;
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function saveTag(): bool
    {
        $post = Yii::$app->request->post('Tags');

        if (!empty($post['_id'])) {
            $tag = Tags::find()->where(['_id' => new ObjectId($post['_id'])])->one();
        } else {
            $tag = new Tags();
        }

        if ($tag->load(Yii::$app->request->post())) {
            Yii::$app->cache->delete("tags");
            $tag->save();
            return true;
        }

        return false;
    }
}