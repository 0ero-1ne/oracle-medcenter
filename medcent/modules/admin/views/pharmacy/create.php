<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pharmacy $model */

$this->title = 'Create Pharmacy';
$this->params['breadcrumbs'][] = ['label' => 'Pharmacies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pharmacy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
