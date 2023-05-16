<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Persons $modelPerson */
/** @var yii\widgets\ActiveForm $form */
$this->title = 'СТАРОМЕД - Добавить пациента';
?>

<div class="persons-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($modelPerson, 'FIRST_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelPerson, 'SECOND_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelPerson, 'LAST_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelPerson, 'BIRTH_DATE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelPerson, 'GENDER')->dropDownList([
        'm' => 'Male',
        'f' => 'Female'
    ], ['prompt' => 'Select gender...']) ?>

    <?= $form->field($modelPatient, 'PHONE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
