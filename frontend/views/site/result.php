<?php

/** @var $result bool */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'action' =>['save-tag'],
    'options' => ['class' => 'form-horizontal tag-form'],
]);
?>
    <div class="card">
        <span class="icon-file-text"></span>
        <?php if ($result) { ?>
            <div class="card-title">
                Успешно
            </div>
        <?php } else { ?>
            <div class="card-title">
                Ошибка
            </div>
        <?php } ?>
    </div>
<?php ActiveForm::end(); ?>