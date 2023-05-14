<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TreatmentsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="treatments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'EMPLOYEE_ID') ?>

    <?= $form->field($model, 'PATIENT_ID') ?>

    <?= $form->field($model, 'START_OF_TREATMENT') ?>

    <?= $form->field($model, 'END_OF_TREATMENT') ?>

    <?php // echo $form->field($model, 'DIAGNOSIS') ?>

    <?php // echo $form->field($model, 'TREATMENT_INFO') ?>

    <?php // echo $form->field($model, 'RECOMMENDATIONS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
