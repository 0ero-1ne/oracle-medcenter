<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PassportsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="passports-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'PASSPORT_NUMBER') ?>

    <?= $form->field($model, 'DATE_OF_ISSUE') ?>

    <?= $form->field($model, 'DATE_OF_EXPIRY') ?>

    <?= $form->field($model, 'AUTHORITY') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
