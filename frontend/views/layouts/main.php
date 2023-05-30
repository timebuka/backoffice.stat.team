<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
Ре    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="header">
        <div class="header_company">
            <?php echo Html::a(Yii::$app->name, ['/site/view-charts']) ?>
            <?php echo Html::img('@web/images/logo-removebg.png', ['alt' => 'Наш логотип', 'class' => 'logo']); ?>
        </div>
        <div class="header_login">
            <?php if (Yii::$app->user->isGuest) {
                echo Html::a('Login', ['/site/login']);
            } else {
                echo Html::beginForm(['/site/logout'], 'post');
                echo Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                );
                echo Html::endForm();
            } ?>
        </div>
    </div>

        <div class="box">
            <div class="sidebar">
                <ul class="sidebar_nav">
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <li><span class="icon-home"></span><?php echo Html::a('Графики', ['/site/view-charts']) ?></li>
                        <li><span class="icon-book"></span><?php echo Html::a('Редактор тегов', ['/site/tags-control']) ?></li>
                        <li><span class="icon-pencil"></span><?php echo Html::a('Ввод данных', ['/site/entry']) ?></li>
                    <?php } else { ?>
                        <li><span class="icon-lock"></span><?php echo Html::a('Получить хэш', ['/site/crypt']) ?></li>
                    <?php } ?>
            </div>
            <div class="content">
                    <section>
                        <?php echo Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        <?php echo Alert::widget() ?>
                        <?php echo $content ?>
                    </section>
            </div>
        </div>

</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
