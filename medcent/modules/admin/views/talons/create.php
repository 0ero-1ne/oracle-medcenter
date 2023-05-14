<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Talons $model */

$this->title = 'Create Talons';
$this->params['breadcrumbs'][] = ['label' => 'Talons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
