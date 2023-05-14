<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PersonAddress $model */

$this->title = 'Update Person Address: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Person Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="person-address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
