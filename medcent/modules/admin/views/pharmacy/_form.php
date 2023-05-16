<?php

use app\models\Suppliers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pharmacy $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pharmacy-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($model, 'DRUG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRICE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STOCK')->textInput() ?>

    <?php
        $recipeTypes = [
            '0' => 'No',
            '1' => 'Yes'
        ]
    ?>

    <?= $form->field($model, 'NEED_RECIPE')->dropDownList($recipeTypes, ['prompt' => 'Select recipe type']) ?>

    <?php
        $suppliers = Suppliers::find()->asArray()->all();
        $suppliersList = [];

        foreach ($suppliers as $supplier) {
            $suppliersList[$supplier['ID']] = $supplier['SUPPLIER_NAME'].' ('.$supplier['SUPPLIER_COUNTRY'].')';
        }
    ?>

    <?= $form->field($model, 'SUPPLIER_ID')->dropDownList($suppliersList, ['prompt' => 'Select supplier']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
