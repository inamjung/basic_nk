<?php 

namespace app\controllers;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class ReportsController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }

        public function actionReferout($date1=null,$date2=null,$hospname=null){
        
        if ($date1 == null) {
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');           
        }
        
        $sql="SELECT ro.refer_hospcode,CONCAT(ho.hosptype,ho.`name`) AS hospname,count(ro.refer_hospcode)AS cc FROM referout ro
LEFT OUTER JOIN hospcode ho ON ho.hospcode=ro.refer_hospcode
WHERE ho.chwpart not in(SELECT chwpart FROM hospcode WHERE chwpart='38' or chwpart='39' or chwpart='41'or chwpart='42'or chwpart='43'
or chwpart='47'or chwpart='48')
AND ro.refer_type='2'
AND ro.refer_date BETWEEN '$date1' AND '$date2'
GROUP BY ro.refer_hospcode
ORDER BY ho.`name`";
        $connection = Yii::$app->db3;
        $data = $connection->createCommand($sql)->queryAll();
        
         for ($i = 0; $i < sizeof($data); $i++) {            
            $cc[] = $data[$i]['cc'] * 1;            
            $hospname[] = $data[$i]['hospname'];
        }

         $dataProvider = new ArrayDataProvider([
                'allModels'=>$data,               
            ]);
        return $this->render('referout',[
            'dataProvider'=>$dataProvider,
            //'rawData' => $rawData,
            'sql' => $sql, 
            'date1'=>$date1,
            'date2'=>$date2,
            'hospname'=>$hospname,
            'cc'=>$cc
        ]); 
        
    }
    
    public function actionReferin($date1=null,$date2=null){
        
        if ($date1 == null) {
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');           
        }
        
        $sql="SELECT ro.refer_hospcode,CONCAT(ho.hosptype,ho.`name`) AS hospname,count(ro.refer_hospcode)AS cc FROM referout ro
LEFT OUTER JOIN hospcode ho ON ho.hospcode=ro.refer_hospcode
WHERE ho.chwpart not in(SELECT chwpart FROM hospcode WHERE chwpart='38' or chwpart='39' or chwpart='41'or chwpart='42'or chwpart='43'
or chwpart='47'or chwpart='48')
AND ro.refer_type='2'
AND ro.refer_date BETWEEN '$date1' AND '$date2'
GROUP BY ro.refer_hospcode
ORDER BY ho.`name`";
        
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rawData,
        ]);
        
        return $this->render('referin',[
            'dataProvider'=>$dataProvider,
            'rawData' => $rawData,
            'sql' => $sql, 
            'date1'=>$date1,
            'date2'=>$date2
        ]); 
        
    }
}






?>

