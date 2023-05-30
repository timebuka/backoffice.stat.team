<?php

/** @var $model object */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Gen Crypt';

?>

<div class="card">
    <span class="icon-lock"></span>
    <div class="card-title">Зашифровать</div>
    <div class="card-form">
        <?php $form = ActiveForm::begin(['action' => 'gen-crypt', 'id' => 'card-form']); ?>
        <?php echo $form->field($model, 'password')->label('Пароль'); ?>
        <div class="card-btn_item">
            <div class="card-btn_bg"></div>
            <?php echo Html::submitButton('Генерировать ХЭШ', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>

<div class="content">
    <div class="card"><!-- Ответ сервера будем выводить сюда --></div>
</div>


