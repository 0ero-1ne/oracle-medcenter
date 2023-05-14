<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BranchDepartment $model */

$this->title = 'Create Branch Department';
$this->params['breadcrumbs'][] = ['label' => 'Branch Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-department-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
