<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Addresses $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="addresses-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($model, 'REGION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOWN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STREET')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOUSE_NUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FLAT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
