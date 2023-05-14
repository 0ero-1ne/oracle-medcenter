<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pharmacy $model */

$this->title = 'Update Pharmacy: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Pharmacies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pharmacy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
