<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Persons $model */

$this->title = 'Create Persons';
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
