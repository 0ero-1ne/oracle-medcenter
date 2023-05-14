<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EmployeesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employees-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'AUTH_DATA') ?>

    <?= $form->field($model, 'PERSON_ID') ?>

    <?= $form->field($model, 'POSITION_ID') ?>

    <?php // echo $form->field($model, 'HIRE_DATE') ?>

    <?php // echo $form->field($model, 'EDUCATION') ?>

    <?php // echo $form->field($model, 'PHONE') ?>

    <?php // echo $form->field($model, 'SALARY') ?>

    <?php // echo $form->field($model, 'ON_VACATION') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
