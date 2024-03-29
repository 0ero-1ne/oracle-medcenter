<?php

use app\models\Pharmacy;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PharmacySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pharmacies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pharmacy-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pharmacy', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'DRUG',
            'PRICE',
            'STOCK',
            'NEED_RECIPE',
            //'SUPPLIER_ID',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pharmacy $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID' => $model->ID]);
                 }
            ],
        ],
    ]); ?>


</div>
