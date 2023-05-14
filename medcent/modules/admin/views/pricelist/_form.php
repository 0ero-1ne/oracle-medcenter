<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pricelist $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pricelist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'POSITION_ID')->textInput() ?>

    <?= $form->field($model, 'SERVICE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRICE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
