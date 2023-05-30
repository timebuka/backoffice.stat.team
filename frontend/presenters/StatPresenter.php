<?php

namespace frontend\presenters;

use frontend\models\form\EntryForm;
use frontend\models\metrics\DiscussionStat;
use frontend\models\metrics\Tags;
use frontend\services\ManipulationModelsService;
use MongoDB\BSON\ObjectId;
use Yii;
use yii\helpers\ArrayHelper;

class StatPresenter
{
    private ManipulationModelsService $manipulationModels;

    public function __construct()
    {
        $this->manipulationModels = new ManipulationModelsService();
        $this->formHashPassword = new EntryForm();
    }

    public function getArrayOutput()
    {
        $loadModels = new ManipulationModelsService();
        $models = $loadModels->loadModels();
        extract($models);

        $merge = array_merge(
            $discussion->getResultData(),
            $releases->getResultData(),
            $development->getResultData(),
            $testing->getResultData(),
            $testCases->getResultData(),
            $circumstances->getResultData()
        );

        $rus = Yii::$app->params['translate'];
        foreach ($merge as $num => $element) {
            foreach ($element as $name => $value) {
                if ($name == 'name') {
                    $newArray[$num][$name] = $rus[$value];
                } else {
                    $newArray[$num][$name] = $value;
                }
            }
        }

        return json_encode($newArray, JSON_UNESCAPED_UNICODE);
    }

    public function getDatesOutput()
    {
        $discussion = new DiscussionStat();
        $dates = $discussion->getDates();

        return json_encode($dates, JSON_UNESCAPED_UNICODE);
    }

    public function getTags(): array
    {
        return ArrayHelper::map(Tags::find()->all(), fn($model) => (string) $model->_id, 'name');
    }

    public function getResultSave()
    {
        $result = $this->manipulationModels->saveInfoIteration(Yii::$app->request->post());

        return Yii::$app->controller->renderPartial('result', [
            'result' => $result
        ]);
    }

    public function renderEntry()
    {
        $models = $this->manipulationModels->loadModels();
        $tags = $this->getTags();

        return Yii::$app->controller->render('entry', [
                'tags' => $tags,
                'discussion' => $models['discussion'],
                'releases' => $models['releases'],
                'development' => $models['development'],
                'testing' => $models['testing'],
                'testCases' => $models['testCases'],
                'circumstances' => $models['circumstances']
            ]);
    }

    public function renderTags()
    {
        $tags = Yii::$app->cache->getOrSet("tags", function () {
            return Tags::find()->asArray()->all();
        });

        return Yii::$app->controller->render('tags/index', [
            'tags' => $tags
        ]);
    }

    public function renderTagEditTab($id)
    {
        $tag = Tags::find()->where(['_id' => new ObjectId($id)])->one();
        return Yii::$app->controller->renderPartial('tags/subview/_edit', [
            'tag' => $tag
        ]);
    }

    public function getResultSaveTag()
    {
        if ($this->manipulationModels->saveTag()) {
            $tags = Tags::find()->asArray()->all();
            return Yii::$app->controller->renderPartial('tags/index', [
                'tags' => $tags
            ]);
        }

        return Yii::$app->controller->redirect(['site/tags-control']);
    }

    public function getNewTag()
    {
        $tag = new Tags();
        return Yii::$app->controller->renderPartial('tags/subview/_create', [
            'tag' => $tag
        ]);
    }
}