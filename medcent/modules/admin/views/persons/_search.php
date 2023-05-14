<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PersonsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="persons-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'FIRST_NAME') ?>

    <?= $form->field($model, 'SECOND_NAME') ?>

    <?= $form->field($model, 'LAST_NAME') ?>

    <?= $form->field($model, 'PASSPORT_ID') ?>

    <?php // echo $form->field($model, 'BIRTH_DATE') ?>

    <?php // echo $form->field($model, 'GENDER') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
