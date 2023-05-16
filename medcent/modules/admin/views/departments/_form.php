<?php

use app\models\Addresses;
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

    <?= $form->field($model, 'DEPARTMENT_NAME')->textInput(['maxlength' => true]) ?>

    <?php
        $addresses = Addresses::find()->asArray()->all();
        $list = [];
        
        foreach ($addresses as $address) {
            $list[$address['ID']] = $address['REGION'] . ', '
                . $address['TOWN'] . ', '
                . $address['STREET'] . ', '
                . $address['HOUSE_NUMBER']
                . ($address['FLAT'] ? ', ' . $address['FLAT'] : '');
        }
    ?>

    <?= $form->field($model, 'ADDRESS_ID')->dropDownList($list, ['prompt' => 'Select address']) ?>

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
            $listE[$employee['ID']] = $employee['POSITION_NAME'] .' ('
                . $employee['SECOND_NAME'].' '
                . $employee['FIRST_NAME'].' '
                . $employee['LAST_NAME'];
        }
    ?>

    <?= $form->field($model, 'DEPARTMENT_MANAGER')->dropDownList($listE, ['prompt' => 'Select manager']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
