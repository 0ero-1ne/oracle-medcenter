<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Treatments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="treatments-form">

    <?php $form = ActiveForm::begin([
        'id' => 'test-form'
    ]); ?>

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
                . $employee['LAST_NAME'] . ')';
        }
    ?>

    <?= $form->field($model, 'EMPLOYEE_ID')->dropDownList($listE, ['prompt' => 'Select employee']) ?>
   
    <?php
        $patients = Yii::$app->db->createCommand(
            'SELECT PERSONS.FIRST_NAME,
                            PERSONS.SECOND_NAME,
                            PERSONS.LAST_NAME,
                            PERSONS.BIRTH_DATE,
                            PATIENTS.ID,
                            PATIENTS.PHONE
            FROM PERSONS
            JOIN PATIENTS ON PATIENTS.PERSON_ID = PERSONS.ID'
        )->queryAll();

        foreach ($patients as $patient) {
            $listP[$patient['ID']] = $patient['SECOND_NAME'].' '
                . $patient['FIRST_NAME'].' '
                . $patient['LAST_NAME'].' ( '
                . $patient['PHONE'] . ', '
                . $patient['BIRTH_DATE'] . ' )';
        }
    ?>

    <?= $form->field($model, 'PATIENT_ID')->dropDownList($listP, ['prompt' => 'Select patient']) ?>

    <?= $form->field($model, 'START_OF_TREATMENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'END_OF_TREATMENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DIAGNOSIS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TREATMENT_INFO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RECOMMENDATIONS')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
