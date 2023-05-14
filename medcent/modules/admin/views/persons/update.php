<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Persons $model */

$this->title = 'Update Persons: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="persons-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
