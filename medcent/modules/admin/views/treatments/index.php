<?php

use app\models\Treatments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TreatmentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Treatments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treatments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Treatments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'EMPLOYEE_ID',
            'PATIENT_ID',
            'START_OF_TREATMENT',
            'END_OF_TREATMENT',
            //'DIAGNOSIS',
            //'TREATMENT_INFO',
            //'RECOMMENDATIONS',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Treatments $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID' => $model->ID]);
                 }
            ],
        ],
    ]); ?>


</div>
