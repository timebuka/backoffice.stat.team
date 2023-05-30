<?php

/** @var $tag object */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'action' =>['save-tag'],
    'options' => ['class' => 'form-horizontal tag-form'],
]);
?>
    <div class="card">
        <span class="icon-file-text"></span>
        <div class="card-title">
            Добавление тега
        </div>
        <div class="card-info">
            <?php
            if (isset($tag->id)) {
                echo $form->field($tag, '_id')
                    ->textInput(['class' => 'form-control card-info_inline_plan hide'])
                    ->label('');

            } ?>
            <div class="card-info_inline">
                <?php
                echo $form->field($tag, 'name')
                    ->textInput(['class' => 'form-control card-info_inline_plan'])
                    ->label('Наименование тега');
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="button-box">
                <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary save-tag']);?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>