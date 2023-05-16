<?php

use app\models\Positions;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Pricelist $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pricelist-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?php
        $positions = Positions::find()->asArray()->all();
    ?>

    <?= $form->field($model, 'POSITION_ID')->dropDownList(ArrayHelper::map($positions, 'ID', 'POSITION_NAME'), ['prompt' => 'Select position']) ?>

    <?= $form->field($model, 'SERVICE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRICE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
