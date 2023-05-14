<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BranchDepartment $model */

$this->title = 'Update Branch Department: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Branch Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="branch-department-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
