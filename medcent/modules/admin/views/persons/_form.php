<?php

use app\models\Passports;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Persons $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="persons-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($model, 'FIRST_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SECOND_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LAST_NAME')->textInput(['maxlength' => true]) ?>

    <?php
        $passports = ArrayHelper::map(Passports::find()->asArray()->all(), 'ID', 'PASSPORT_NUMBER')
    ?>

    <?= $form->field($model, 'PASSPORT_ID')->dropDownList($passports, ['prompt' => 'Select passport number...']) ?>

    <?= $form->field($model, 'BIRTH_DATE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GENDER')->dropDownList([
        'm' => 'Male',
        'f' => 'Female'
    ], ['prompt' => 'Select gender...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
