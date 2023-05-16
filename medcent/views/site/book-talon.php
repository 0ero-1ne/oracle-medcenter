<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Talons $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = "СТАРОМЕД - Бронировавние талона";
$userId = Yii::$app->user->identity->EMAIL;
?>

<div class="talons-form">

    <?php $form = ActiveForm::begin([
        'id' => 'test-form'
    ]); ?>

    <?php
        $listP = [];
        foreach ($patients as $patient) {
            $listP[$patient['ID']] = $patient['SECOND_NAME'].' '
                . $patient['FIRST_NAME'].' '
                . $patient['LAST_NAME'];
        }
    ?>

    <?= $form->field($model, 'PATIENT_ID')->dropDownList($listP, ['prompt' => 'Выберите пациента']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
