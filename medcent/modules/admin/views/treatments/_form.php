<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Treatments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="treatments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'EMPLOYEE_ID')->textInput() ?>

    <?= $form->field($model, 'PATIENT_ID')->textInput() ?>

    <?= $form->field($model, 'START_OF_TREATMENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'END_OF_TREATMENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DIAGNOSIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TREATMENT_INFO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RECOMMENDATIONS')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
