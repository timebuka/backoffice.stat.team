<?php

/** @var $tags array */


use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]);
?>

<?php echo Html::a('Добавить тег', ['/site/add-tag'], ['class' => 'btn btn-default ajax']) ?>

<div class="row_flex">
    <div class="item_tab_pane">
        <ul class="nav nav_custom">
            <?php foreach ($tags as $tag) { ?>
                <li class="item_li">
                    <?php echo Html::a($tag['name'], ['/site/edit-tag', 'id' => (string) $tag['_id']], ['class' => 'ajax']) ?>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="tab-content">

    </div>
</div>

