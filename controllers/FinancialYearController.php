<?php

namespace app\controllers;

use Yii;
use app\models\FinancialYear;
use app\models\FinancialYearSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OcrEntry;
use app\models\Budget;
use app\models\BudgetHeadStatus;
/**
 * FinancialYearController implements the CRUD actions for FinancialYear model.
 */

class FinancialYearController extends Controller
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
     * Lists all FinancialYear models.
     * @return mixed
     */
    public function actionIndex()
    {  
        if( Yii::$app->user->can("admin")){
        $searchModel = new FinancialYearSearch();
        $searchModel->year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    else{
        throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
    }
    }
    
    public function actionUserindex()
    {   
        $searchModel = new FinancialYearSearch();
       $searchModel->dep_id = Yii::$app->user->identity->id;
       $searchModel->year = $this->yr();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('userindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
   
    }
    
    public function actionQuery($depid){
        $q = $_REQUEST["depid"];
    
            $rowf=(new \yii\db\Query())
            ->select('*')
            ->from('dept_details') 
            ->where(['dept_id'=>$q])
            ->all();
           
            $y= $rowf[0]['dep_hod'];
            echo $y ;
    }

    /**
     * Displays a single FinancialYear model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if( Yii::$app->user->can("admin")){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
    else{
        throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
    }
    }
    
    public function actionUserview()
    {
       return $this->render('userview'//, [
//            'model' => $this->findModel($id),]
        );
    }
    /**
     * Creates a new FinancialYear model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if( Yii::$app->user->can("admin")){
            $model = new FinancialYear();
            $model->user_id = Yii::$app->user->identity->id;
            $model->source_ip = Yii::$app->request->userIP;
            
           
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $rowe=(new \yii\db\Query())
                    ->select('*')
                    ->from('financial_year_tbl') 
                    ->where(['dep_id'=> $model->dep_id, 'year'=> $model->year])
                    ->all(); 
                if($rowe){
                     Yii::$app->session->setFlash('contactFormSubmitted');
                     return $this->refresh();
                }
                else{
                    
                    $depmail=(new \yii\db\Query())
                    ->select('dep_email')
                    ->from('dept_details') 
                    ->where(['dept_id'=> $model->dep_id])
                    ->all();
                    
                    $email=$depmail[0]['dep_email'];
                    
                    $response = \Yii::$app->mailer->compose('MailStruct2',
                        ['to'=>$email,
                            
                            'year' => $model->year,
                            'ammount'=>$model->total_fund,
                         ]) ->setFrom([\Yii::$app->params['supportEmail'] => 'OCM-Admin'])
                                 ->setTo($email)
                                 ->setSubject('Fund is allocated for the year-'.$model->year)
                                 ->send();
            
                         $model->save();
                         
                return $this->redirect(['view', 'id' => $model->id]);
                        
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        else {
            throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
        }
    }

    /**
     * Updates an existing FinancialYear model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if( Yii::$app->user->can("admin")){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        }
        else {
            throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
        }
        
    }

    /**
     * Deletes an existing FinancialYear model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $modelbhs = new BudgetHeadStatus();
                $rowf=(new \yii\db\Query())
                    ->select('*')
                    ->from('budget_head_status') 
                    ->where(['year'=>$model->year,'dep_id'=>$model->dep_id])
                    ->all();
           
        foreach($rowf as $key=>$row){
                     $modelbhs = BudgetHeadStatus::findOne($row['id']);
                     $modelbhs->delete();
        }
        
         $modelbud = new Budget();
                $rowf=(new \yii\db\Query())
                    ->select('*')
                    ->from('budget') 
                    ->where(['year'=>$model->year,'dep_id'=>$model->dep_id])
                    ->all();
        foreach($rowf as $key=>$row){
                     $modelbud = Budget::findOne($row['id']);
                     $modelbud->delete();
        }
        
        $modelocr = new OcrEntry();
                $rowf=(new \yii\db\Query())
                    ->select('*')
                    ->from('ocr_entry') 
                    ->where(['finance_year'=>$model->year,'dep_id'=>$model->dep_id])
                    ->all();
           // var_dump($rowf);die;
        foreach($rowf as $key=>$row){
            
                     $modelocr = OcrEntry::findOne($row['id']);                     
                     $modelocr->delete();
        }
        
        
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the FinancialYear model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FinancialYear the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FinancialYear::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
