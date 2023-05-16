<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DepartmentEmployee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="department-employee-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?php
        $departments = YII::$app->db->createCommand(
            'SELECT DEPARTMENTS.ID,
                            DEPARTMENTS.DEPARTMENT_NAME,
                            ADDRESSES.REGION,
                            ADDRESSES.TOWN,
                            ADDRESSES.STREET,
                            ADDRESSES.HOUSE_NUMBER,
                            ADDRESSES.FLAT
            FROM ADDRESSES
            JOIN DEPARTMENTS ON DEPARTMENTS.ADDRESS_ID = ADDRESSES.ID'
        )->queryAll();

        foreach ($departments as $department) {
            $list[$department['ID']] = $department['DEPARTMENT_NAME'] .' ('
                . $department['REGION'].', '
                . $department['TOWN'].', '
                . $department['STREET'].', '
                . $department['HOUSE_NUMBER']
                . ($department['FLAT'] ? ', ' . $department['FLAT'] . ')' : ')');
        }
    ?>

    <?= $form->field($model, 'DEPARTMENT_ID')->dropDownList($list, ['prompt' => 'Select department']) ?>

    <?php
        $employees = Yii::$app->db->createCommand(
            'SELECT PERSONS.FIRST_NAME,
                            PERSONS.SECOND_NAME,
                            PERSONS.LAST_NAME,
                            EMPLOYEES.ID,
                            POSITIONS.POSITION_NAME
            FROM PERSONS
            JOIN EMPLOYEES ON EMPLOYEES.PERSON_ID = PERSONS.ID
            JOIN POSITIONS ON POSITIONS.ID = EMPLOYEES.POSITION_ID'
        )->queryAll();

        foreach ($employees as $employee) {
            $list[$employee['ID']] = $employee['POSITION_NAME'] .' ('
                . $employee['SECOND_NAME'].' '
                . $employee['FIRST_NAME'].' '
                . $employee['LAST_NAME'];
        }
    ?>

    <?= $form->field($model, 'EMPLOYEE_ID')->dropDownList($list, ['prompt' => 'Select employee']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
