<?php

use app\models\Employees;
use app\models\Persons;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Departments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'DEPARTMENT_NAME')->textInput(['maxlength' => true]) ?>

    <?php
        $employees = YII::$app->db->createCommand(
            'SELECT EMPLOYEES.ID,
                            PERSONS.FIRST_NAME,
                            PERSONS.SECOND_NAME,
                            PERSONS.LAST_NAME
            FROM EMPLOYEES
            JOIN PERSONS ON EMPLOYEES.PERSON_ID = PERSONS.ID'
        )->queryAll();

        $list = [];

        foreach ($employees as $employee) {
            $list[$employee['ID']] = $employee['FIRST_NAME'].' '.$employee['SECOND_NAME'].' '.$employee['LAST_NAME'];
        }
    ?>

    <?= $form->field($model, 'DEPARTMENT_MANAGER')->dropDownList($list, ['prompt' => 'Select manager...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
