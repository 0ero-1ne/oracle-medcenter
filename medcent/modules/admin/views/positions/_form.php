<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Positions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="positions-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'POSITION_NAME')->textInput(['maxlength' => true]) ?>

    <?php
        $positionTypes = [
            'doctor' => 'Doctor',
            'head_doctor' => 'Head doctor',
            'programmer' => 'Programmer',
            'cleaner' => 'Cleaner',
            'security' => 'Security'
        ];
    ?>

    <?= $form->field($model, 'POSITION_TYPE')->dropDownList($positionTypes, ['prompt' => 'Select position type']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
