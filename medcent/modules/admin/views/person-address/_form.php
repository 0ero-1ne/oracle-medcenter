<?php

use app\models\Persons;
use app\models\Addresses;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PersonAddress $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="person-address-form">

    <?php $form = ActiveForm::begin([
        'id' => 'test-form'
    ]); ?>

<?php
        $persons = Persons::find()->asArray()->all();

        foreach ($persons as $person)
        {
            $listP[$person['ID']] = $person['SECOND_NAME'].', '
                . $person['FIRST_NAME'].', '
                . $person['LAST_NAME'].', '
                . $person['BIRTH_DATE'];
        }
    ?>

    <?= $form->field($model, 'PERSON_ID')->dropDownList($listP, ['prompt' => 'Select person']) ?>

    <?php
        $addresses = Addresses::find()->asArray()->all();

        foreach ($addresses as $address)
        {
            $listA[$address['ID']] = $address['REGION'].', '
                . $address['TOWN'].', '
                . $address['STREET'].', '
                . $address['HOUSE_NUMBER']
                . ($address['FLAT'] ? ', ' . $address['FLAT'] : '');
        }
    ?>

    <?= $form->field($model, 'ADDRESS_ID')->dropDownList($listA, ['prompt' => 'Select address']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
