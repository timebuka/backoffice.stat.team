<?php
$this->registerJsFile("https://code.highcharts.com/highcharts.js", ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile("https://code.highcharts.com/modules/exporting.js", ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile("https://code.highcharts.com/themes/dark-unica.js", ['depends' => [\yii\web\JqueryAsset::class]]);

$this->registerJsFile('@web/js/highchartsSettings.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div id="containerHighcharts" style="height: 600px; margin-top: 2em"></div>
<div class="buttons">
    <button class='discussion btn btn-charts'>
        Обсуждение
    </button>
    <button class='releases btn btn-charts'>
        Релизы
    </button>
    <button class='development btn btn-charts'>
        Разработка
    </button>
    <button class='testing btn btn-charts'>
        Тестирование
    </button>
    <button class='testCases btn btn-charts'>
        Тест-кейсы
    </button>
    <button class='circumstances btn btn-charts'>
        Обстоятельства
    </button>
</div>