<?php

use app\models\Departments;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\BranchDepartment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="branch-department-form">

    <?php $form = ActiveForm::begin([
       'id' => 'test-form',
    ]); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?php
        $addresses = YII::$app->db->createCommand(
            'SELECT ADDRESSES.REGION,
                            ADDRESSES.TOWN,
                            ADDRESSES.STREET,
                            ADDRESSES.HOUSE_NUMBER,
                            ADDRESSES.FLAT,
                            BRANCHES.ID
            FROM ADDRESSES
            JOIN BRANCHES ON BRANCHES.ADDRESS_ID = ADDRESSES.ID'
        )->queryAll();

        foreach ($addresses as $address) {
            $branchesList[$address['ID']] = $address['REGION']
                . ', ' . $address['TOWN']
                . ', ' . $address['STREET']
                . ', ' . $address['HOUSE_NUMBER']
                . ($address['FLAT'] ? ', ' . $address['FLAT'] : '');
        }
    ?>

    <?= $form->field($model, 'BRANCH_ID')->dropDownList($branchesList, ['prompt' => 'Select branch']) ?>

    <?php
        $depratments = Departments::find()->asArray()->all();
    ?>

    <?= $form->field($model, 'DEPARTMENT_ID')->dropDownList(ArrayHelper::map($depratments, 'ID', 'DEPARTMENT_NAME'), ['prompt' => 'Select department']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
