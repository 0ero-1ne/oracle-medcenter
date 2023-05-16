<?php

use app\models\Positions;
use app\models\Users;
use app\models\Persons;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Employees $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?php
        $users = ArrayHelper::map(Users::find()->all(), 'ID', 'EMAIL');
    ?>

    <?= $form->field($model, 'AUTH_DATA')->dropDownList($users, ['prompt' => 'Select user...']) ?>

    <?php
        $persons = Persons::find()->asArray()->all();
        $personsItems = [];
        foreach ($persons as $person) {
            $personsItems[$person['ID']] = $person['FIRST_NAME'] . ' ' . $person['SECOND_NAME'] . ' ' . $person['LAST_NAME'] . ' ' . $person['BIRTH_DATE'];
        }
    ?>

    <?= $form->field($model, 'PERSON_ID')->dropDownList($personsItems, ['prompt' => 'Select person...']) ?>

    <?php
        $positions = Positions::find()->asArray()->all();
    ?>

    <?= $form->field($model, 'POSITION_ID')->dropDownList(ArrayHelper::map($positions, 'ID', 'POSITION_NAME'), ['prompt' => 'Select position...']) ?>

    <?= $form->field($model, 'HIRE_DATE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EDUCATION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SALARY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ON_VACATION')->dropDownList([
        '0' => 'No',
        '1' => 'Yes'
    ], ['prompt' => 'Select vacation type...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
