<?php

use app\models\Users;
use app\models\Persons;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Patients $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="patients-form">

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

    <?= $form->field($model, 'PHONE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
