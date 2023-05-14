<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Passports $model */

$this->title = 'Update Passports: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Passports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="passports-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
