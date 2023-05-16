<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Addresses $model */
/** @var yii\widgets\ActiveForm $form */
$this->title = 'СТАРОМЕД - Добавить адресс';
?>

<div class="addresses-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?php
        $regions = [
            'Минск' => 'Минск',
            'Брест' => 'Брест',
            'Витебск' => 'Витебск',
            'Могилёв' => 'Могилёв',
            'Гомель' => 'Гомель',
            'Гродно' => 'Гродно'
        ]
    ?>

    <?= $form->field($model, 'REGION')->dropDownList($regions, ['prompt' => 'Выберите область']) ?>

    <?= $form->field($model, 'TOWN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STREET')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOUSE_NUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FLAT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
