<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Suppliers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="suppliers-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($model, 'SUPPLIER_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SUPPLIER_COUNTRY')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
