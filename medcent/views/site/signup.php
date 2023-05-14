<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'СТАРОМЕД - Регистрация';
$this->params['breadcrumbs'][] = "Регистрация";
?>
<div class="site-signup">
    <h1><?= Html::encode("Регистрация") ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="offset-lg-0 col-lg-11">
                <?= Html::submitButton('Создать аккаунт', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                <p id="to-login"><a href="/login">Уже есть аккаунт? Войти</a></p>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
