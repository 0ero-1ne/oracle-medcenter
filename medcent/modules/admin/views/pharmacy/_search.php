<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PharmacySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pharmacy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'DRUG') ?>

    <?= $form->field($model, 'PRICE') ?>

    <?= $form->field($model, 'STOCK') ?>

    <?= $form->field($model, 'NEED_RECIPE') ?>

    <?php // echo $form->field($model, 'SUPPLIER_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
