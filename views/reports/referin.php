<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = '';
$datas = $dataProvider->getModels();
?>

<?php
$form = ActiveForm::begin(['method' => 'get',
'action' => Url::to(['reports/referin']),]);
?>
<div class='well'> 
    ระหว่าง:
    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?php
            echo yii\jui\DatePicker::widget([
                'name' => 'date1',
                'value' => $date1,
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => [
                    'class' => 'form-control'
                ],
            ]);
            ?>
            ถึง:
            <?php
            echo yii\jui\DatePicker::widget([
                'name' => 'date2',
                'value' => $date2,
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => [
                    'class' => 'form-control'
                ],
            ]);
            ?>
        </div> 
        <div>
            <button class='btn btn-danger'>ประมวลผล</button> 
        </div>
    </div><br>
    <?php ActiveForm::end(); ?>

    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'responsive' => TRUE,
        'hover' => true,
        'striped' => false,
        //'floatHeader' => true,
        'showPageSummary' => true,
//        'toolbar' => [
//            '{export}' => false,
//            '{toggleData}' => false
//        ],
        'panel' => [
            'heading' => 'รายงาน ReferIn',
            'type' => \kartik\grid\GridView::TYPE_PRIMARY,
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'refer_hospcode',
                'label' => 'รหัสสถานบริการ',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'hospname',
                'label' => 'สถานบริการ',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-left'],
                'pageSummary' => 'รวมทั้งหมด'
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'pageSummary' => true,
                'attribute' => 'cc',
                'format' => 'integer',
                'label' => 'จำนวนครั้ง',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
        ]
    ]);
    ?>
