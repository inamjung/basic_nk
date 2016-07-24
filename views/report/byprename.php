<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;


$this->params['breadcrumbs'][] = '';
$datas = $dataProvider->getModels();
?>

<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'responsive' => TRUE,
    'hover' => true,
    'striped' => false,
    'floatHeader' => true,
    'showPageSummary' => true,
    'toolbar' => [
        '{export}' => false,
        '{toggleData}' => false
    ],
    'panel' => [
        'heading' => '',
        'type' => \kartik\grid\GridView::TYPE_PRIMARY,
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        
                [
                    'attribute' => 'prename',
                    'label' => 'prename',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-left'],
                ],
                [
                    'attribute' => 'tt',
                    'label' => 'Total',
                    'pageSummary' => true,
                    'format' => 'integer',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-left'],
                ],
            ]
        ]);
        ?>
