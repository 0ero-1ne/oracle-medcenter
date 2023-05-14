<?php

use app\models\Addresses;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Branches $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?php
        $addresses = Addresses::find()->asArray()->all();

        foreach ($addresses as $address) {
            $addressesList[$address['ID']] = $address['REGION'] . ', ' . $address['TOWN'] . ', ' . $address['STREET'] . ', ' . $address['HOUSE_NUMBER'] . ($address['FLAT'] ? ', ' . $address['FLAT'] : '');
        }
    ?>

    <?= $form->field($model, 'ADDRESS_ID')->dropDownList($addressesList, ['prompt' => 'Select address']) ?>

    <?php
        $employees = YII::$app->db->createCommand(
            'SELECT EMPLOYEES.ID,
                            PERSONS.FIRST_NAME,
                            PERSONS.SECOND_NAME,
                            PERSONS.LAST_NAME
            FROM EMPLOYEES
            JOIN PERSONS ON EMPLOYEES.PERSON_ID = PERSONS.ID'
        )->queryAll();

        foreach ($employees as $employee) {
            $employeesList[$employee['ID']] = $employee['FIRST_NAME'].' '.$employee['SECOND_NAME'].' '.$employee['LAST_NAME'];
        }
    ?>

    <?= $form->field($model, 'BRANCH_MANAGER')->dropDownList($employeesList, ['prompt' => 'Select manager']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
