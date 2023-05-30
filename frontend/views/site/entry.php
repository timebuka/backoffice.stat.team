<?php

/** @var $tags array */
/** @var $discussion object */
/** @var $releases object */
/** @var $development object */
/** @var $testing object */
/** @var $testCases object */
/** @var $circumstances object */


use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<?php
$form = ActiveForm::begin([
    'id' => 'form-data',
    'action' => 'save-entry',
    'options' => ['class' => 'form-horizontal'],
]);
?>
    <div class="card">
        <div class="card-title">
            Обсуждение
        </div>
        <div class="card-info">
            <?php echo $form->field($discussion, 'date')->widget(DatePicker::classname(),
                [
                    'options' => ['class' => 'form-control'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ])->label('Дата');?>
            <div class="card-info_inline">
                <?php echo $form->field($discussion, 'plan')->textInput(['class' => 'form-control card-info_inline_plan input-custom'])->label('Запланировано времени');?>
                <?php echo $form->field($discussion, 'real')->textInput(['class' => 'form-control card-info_inline_real input-custom'])->label('Потратили');?>
            </div>
            <?php echo $form->field($discussion, 'reason')->widget(Select2::classname(), [
                'data' => $tags,
                'language' => 'ru',
                'options' => ['multiple' => true,],
            ])->label('Причины неуспеха');?>
            <?php echo $form->field($discussion, 'description')->textInput(['class' => 'form-control input-custom'])->label('Заметка');?>
        </div>
    </div>

    <div class="card">
        <span class="icon-file-text"></span>
        <div class="card-title">
            Релизы
        </div>
        <div class="card-info">
            <div class="card-info_inline">
                <?php echo $form->field($releases, 'plan')->textInput(['class' => 'form-control card-info_inline_plan'])->label('Кол-во запланировано'); ?>
                <?php echo $form->field($releases, 'real')->textInput(['class' => 'form-control card-info_inline_real'])->label('Кол-во успешных'); ?>
            </div>
            <?php echo $form->field($releases, 'reason')->widget(Select2::classname(), [
            'data' => $tags,
            'language' => 'ru',
            'options' => ['multiple' => true],
            ])->label('Теги ошибок'); ?>
            <?php echo $form->field($releases, 'description')->label('Заметка'); ?>
        </div>
    </div>

    <div class="card">
        <span class="icon-file-text"></span>
        <div class="card-title">
            Разработка
        </div>
        <div class="card-info">
            <?php echo $form->field($development, 'tookTasks')->label('Взяли задач'); ?>
            <?php echo $form->field($development, 'countTasksСomplete')->label('Кол-во выполненных задач'); ?>
            <?php echo $form->field($development, 'countTasksNotСomplete')->label('Кол-во невыполненных задач'); ?>
            <?php echo $form->field($development, 'reason')->widget(Select2::classname(), [
            'data' => $tags,
            'language' => 'ru',
            'options' => ['multiple' => true],
            ])->label('Причины неуспеха'); ?>
            <?php echo $form->field($development, 'description')->label('Заметка'); ?>
        </div>
    </div>

    <div class="card">
        <span class="icon-file-text"></span>
        <div class="card-title">
            Тестирование
        </div>
        <div class="card-info">
            <?php echo $form->field($testing, 'tookTasks')->label('Взяли задач'); ?>
            <?php echo $form->field($testing, 'countTasksСomplete')->label('Успешное кол-во задач'); ?>
            <?php echo $form->field($testing, 'countTasksNotСomplete')->label('Неуспешное кол-во задач'); ?>
            <?php echo $form->field($testing, 'reason')->widget(Select2::classname(), [
            'data' => $tags,
            'language' => 'ru',
            'options' => ['multiple' => true],
            ])->label('Причины неуспеха'); ?>
            <?php echo $form->field($testing, 'description')->label('Заметка'); ?>
        </div>
    </div>

    <div class="card">
        <span class="icon-file-text"></span>
        <div class="card-title">
            Тест-кейсы
        </div>
        <div class="card-info">
            <?php echo $form->field($testCases, 'tookTasks')->label('Взяли тест-кейсов'); ?>
            <?php echo $form->field($testCases, 'countTasksСomplete')->label('Успешное кол-во тест-кейсов'); ?>
            <?php echo $form->field($testCases, 'countTasksNotСomplete')->label('Неуспешное кол-во тест-кейсов'); ?>
            <?php echo $form->field($testCases, 'reason')->widget(Select2::classname(), [
            'data' => $tags,
            'language' => 'ru',
            'options' => ['multiple' => true],
            ])->label('Причины неуспеха'); ?>
            <?php echo $form->field($testCases, 'description')->label('Заметка'); ?>
        </div>
    </div>

    <div class="card">
        <span class="icon-file-text"></span>
        <div class="card-title">
            Обстоятельства
        </div>
        <div class="card-info">
            <?php echo $form->field($circumstances, 'countUrgentTasks')->label('Кол-во срочных задач'); ?>
            <?php echo $form->field($circumstances, 'countFailServer')->label('Кол-во аварий на сервере'); ?>
            <?php echo $form->field($circumstances, 'countFailClient')->label('Кол-во аварий на клиенте'); ?>
            <?php echo $form->field($circumstances, 'reason')->widget(Select2::classname(), [
            'data' => $tags,
            'language' => 'ru',
            'options' => ['multiple' => true],
            ])->label('Причины неуспеха'); ?>
            <?php echo $form->field($circumstances, 'description')->label('Заметка'); ?>
        </div>
        <div class="form-group">
            <div class="button-box">
                <?php echo Html::submitButton('Отправить', ['class' => 'btn btn-entry']);?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
<div class="output"><!--Создан для вывода ajax--></div>
