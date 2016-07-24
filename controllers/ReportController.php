<?php
namespace app\controllers;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class ReportController extends controller {    

    public function actionByprename(){       
        
        $sql = "";
        
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
        ]);
        
        return $this->render('byprename',[
            'dataProvider'=>$dataProvider,
            'rawData' => $rawData,
            'sql' => $sql,            
        ]);        
    }
    
    
}



