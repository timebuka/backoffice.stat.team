<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model LoginForm */

use frontend\models\auth\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['action' => 'authentication', 'id' => 'login-form']); ?>

                <?php

                echo $form->field($model, 'username')->textInput(['autofocus' => true]);

                echo $form->field($model, 'password')->passwordInput();

                echo $form->field($model, 'rememberMe')->checkbox();

                ?>

                <div class="form-group">
                    <?php echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
