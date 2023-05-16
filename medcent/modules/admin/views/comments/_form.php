<?php

use app\models\Users;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Comments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin([
        'id' => 'test-form'
    ]); ?>

    <?php
        $users = Users::find()->asArray()->all();
    ?>

    <?= $form->field($model, 'USER_ID')->dropDownList(ArrayHelper::map($users, 'ID', 'EMAIL'), ['prompt' => 'Select user']) ?>

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

    <?= $form->field($model, 'EMPLOYEE_ID')->dropDownList($listE, ['prompt'=>'Select employee']) ?>

    <?= $form->field($model, 'COMMENT_TEXT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
