<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Passports $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="passports-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'PASSPORT_NUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_OF_ISSUE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_OF_EXPIRY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AUTHORITY')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
