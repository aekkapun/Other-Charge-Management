<?php

namespace app\controllers;

use Yii;
use app\models\BudgetTransfer;
use app\models\BudgetTransferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\BudgetHeadStatus;


/**
 * BudgetTransferController implements the CRUD actions for BudgetTransfer model.
 */
class BudgetTransferController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all BudgetTransfer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BudgetTransferSearch();
         $searchModel->year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionUserindex()
    {
        $searchModel = new BudgetTransferSearch();
        $searchModel->dep_id = Yii::$app->user->identity->id;
         $searchModel->year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('userindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BudgetTransfer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BudgetTransfer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BudgetTransfer();
           $model->dep_id = Yii::$app->user->identity->id;
           $model->user_id = Yii::$app->user->identity->id;
           $model->source_ip = Yii::$app->request->userIP;
           $model->status = "pending" ;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $rowf=(new \yii\db\Query())
                    ->select('*')
                    ->from('budget_head_status') 
                    ->where(['year'=>$model->year, 'dep_id'=> $model->dep_id, 'bh_name' => $model->from_bh])
                    ->all();
            $bal = $rowf[0]['bh_balance'];
            
            if( $bal < (float)$model->amount){
                return $this->refresh();
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BudgetTransfer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       
         if( Yii::$app->user->can("admin")){
        $model = $this->findModel($id);
        $model->user_id = Yii::$app->user->identity->id;
        $model->source_ip = Yii::$app->request->userIP;
        
         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             if($model->status == "approved"){
                   $modelbhstatus = new BudgetHeadStatus();
                $rowf=(new \yii\db\Query())
                    ->select('*')
                    ->from('budget_head_status') 
                    ->where(['year'=>$model->year, 'dep_id'=> $model->dep_id, 'bh_name' => $model->from_bh])
                    ->all();
                 $modelbhstatus = BudgetHeadStatus::findOne($rowf[0]['id']);
                 //var_dump($modelbhstatus);
                 $modelbhstatus->bh_total_amount = (float)$modelbhstatus->bh_total_amount - (float)$model->amount;
                 $modelbhstatus->bh_balance = (float)$modelbhstatus->bh_balance - (float)$model->amount;
                // var_dump($modelbhstatus)
                 $modelbhstatus->save(FALSE);
                 $rowf=(new \yii\db\Query())
                    ->select('*')
                    ->from('budget_head_status') 
                    ->where(['year'=>$model->year, 'dep_id'=> $model->dep_id, 'bh_name' => $model->to_bh])
                    ->all();
                 $modelbhstatus = BudgetHeadStatus::findOne($rowf[0]['id']);
                 $modelbhstatus->bh_total_amount = (float)$modelbhstatus->bh_total_amount + (float)$model->amount;
                 $modelbhstatus->bh_balance = (float)$modelbhstatus->bh_balance + (float)$model->amount;
                 
                 $modelbhstatus->save(FALSE);
                 
             }
                 
         
         $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        
         }
         else{
             $model = $this->findModel($id);
        
        $model->user_id = Yii::$app->user->identity->id;
        $model->source_ip = Yii::$app->request->userIP;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('userupdate', [
                'model' => $model,
            ]);
        }
         }
    }

    /**
     * Deletes an existing BudgetTransfer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BudgetTransfer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BudgetTransfer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BudgetTransfer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionQuery($dep,$yr,$bh){
         $x = array();
        $q = $_REQUEST["yr"];
    $r = $_REQUEST["dep"];
    $s = $_REQUEST["bh"];
    $rown =(new \yii\db\Query())
            ->select('*')
           ->from('budget_head_status') 
            ->where(['year'=>$q, 'dep_id'=> $r, 'bh_name'=> $s])
            ->all();

            echo $rown[0]['bh_balance'];
    }
    
    public function actionBudgetrequests()
    {
       if( Yii::$app->user->can("admin")){
        $searchModel = new BudgetTransferSearch();
        $searchModel->status = 'pending';
         $searchModel->year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }
              protected function yr(){
            $mon = date("m");
            if($mon < 04){
                $pyr = date("Y");
                $pyr = $pyr-1;
                $cyr = date("y");
                $year = $pyr.'-'.$cyr;
                return $year;
                //echo $year;
            }
            else{
                $pyr = date("Y");
                $cyr = date("y");
                $cyr = $cyr +1;
                $year = $pyr.'-'.$cyr;
                return $year;
                //echo $year;

            }
          }    
}
