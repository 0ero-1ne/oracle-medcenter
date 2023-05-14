<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Treatments $model */

$this->title = 'Update Treatments: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Treatments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="treatments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
