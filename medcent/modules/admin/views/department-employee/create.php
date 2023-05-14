<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DepartmentEmployee $model */

$this->title = 'Create Department Employee';
$this->params['breadcrumbs'][] = ['label' => 'Department Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
