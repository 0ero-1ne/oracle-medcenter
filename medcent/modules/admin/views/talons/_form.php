<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Talons $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="talons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'TALON_DATE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPLOYEE_ID')->textInput() ?>

    <?= $form->field($model, 'PATIENT_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
