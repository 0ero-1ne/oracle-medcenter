<?php

use app\models\PersonAddress;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PersonAddressSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Person Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-address-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Person Address', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'PERSON_ID',
            'ADDRESS_ID',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PersonAddress $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID' => $model->ID]);
                 }
            ],
        ],
    ]); ?>


</div>
