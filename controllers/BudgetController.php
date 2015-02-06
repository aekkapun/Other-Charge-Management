<?php

namespace app\controllers;

use Yii;
use app\models\Budget;
use app\models\BudgetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Alert;
use app\models\BudgetHeadStatus;
use app\models\OcrEntry;

/**
 * BudgetController implements the CRUD actions for Budget model.
 */
class BudgetController extends Controller
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
public function actionQuery($yr,$dep){
        $q = $_REQUEST["yr"];
    $r = $_REQUEST["dep"];
    $rowf=(new \yii\db\Query())
            ->select('*')
            ->from('financial_year_tbl') 
            ->where(['year'=>$q, 'dep_id'=> $r])
            ->all();
    $y=0;
           if(!empty($rowf)){         
                $y= (int)$rowf[0]['total_fund'];
           }
    echo $y ;
    }
    /**
     * Lists all Budget models.
     * @return mixed
     */
    public function actionIndex()
    {   
        if( Yii::$app->user->can("admin")){
            $searchModel = new BudgetSearch();
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
        $searchModel = new BudgetSearch();
         $searchModel->dep_id = Yii::$app->user->identity->id;
         $searchModel->year = $this->yr();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('userindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Budget model.
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
     * Creates a new Budget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        
        $model = array();
        $model[] = new Budget();
//        $model->user_id = Yii::$app->user->identity->id;
//        $model->source_ip = Yii::$app->request->userIP;
        $postData = Yii::$app->request->post('Budget');
       
        if ($postData != null && is_array($postData)){
            
            $model = array();
            foreach ($postData as $i => $single){
                $model[$i] = new Budget();
                $model[$i]->user_id = Yii::$app->user->identity->id;
             
                $model[$i]->source_ip = Yii::$app->request->userIP;
                
               
            }
        } 
     
        if(Budget::loadMultiple($model, Yii::$app->request->post()) && Budget::validateMultiple($model)){
             //var_dump($model[0]->dep_id);die;
            
             $rowe=(new \yii\db\Query())
                    ->select('*')
                    ->from('budget') 
                    ->where(['dep_id'=> $model[0]->dep_id, 'year'=> $model[0]->year])
                    ->all(); 
                if($rowe){
                     Yii::$app->session->setFlash('wrongBudget');
                     return $this->refresh();
                }
           // $model[0]->date_order= Yii::$app->formatter->asDate($model[0]->date_order, "dd-mm-yyyy");
         
            $rowf=(new \yii\db\Query())
            ->select('*')
            ->from('financial_year_tbl') 
            ->where(['year'=>$model[0]->year, 'dep_id'=> $model[0]->dep_id])
            ->all();
           // var_dump($rowf);die;
            $y= (int)$rowf[0]['total_fund'];

         
           $rows=(new \yii\db\Query())
                ->select('*')
                ->from('budget_heads')        
                ->all(); 
           
          
            foreach($rows as $i => $row){

                $model[$i]->budget_head = $row['bh_name'];
                $model[$i]->file_ref_no = $model[0]->file_ref_no;
                $model[$i]->dep_id = $model[0]->dep_id;
                $model[$i]->date_order = $model[0]->date_order;
                $model[$i]->year = $model[0]->year;
            }
            $x=0;$ocrsum=0;
            foreach($rows as $i => $row){
                $x += (int) $model[$i]->bh_fund;
            }
           foreach($rows as $i => $row){
                $ocrsum += (int) $model[$i]->bh_netfund;
            }
            $z=$y-$x;
            $zocr = $y- $ocrsum;
            if($z==0 && $zocr>=0){
           
                 /*************************Mail-start******************************/
               
            $rowe=(new \yii\db\Query())
                    ->select('dep_email')
                    ->from('dept_details') 
                    ->where(['dept_id'=> $model[0]->dep_id])
                    ->all();   
            $e1 = $rowe[0]['dep_email'];
            
                $response = \Yii::$app->mailer->compose('MailStruct3',
                        ['to'=>$e1,
                             'dep_id' => $model[0]->dep_id,
                            'date'=> $model[0]->date_order,
                            'file_no'=> $model[0]->file_ref_no,
                            
                        'finance_year' => $model[0]->year,
                        'opening_ammount' => $ocrsum,
                       
                        
                       
                            ])
                                 ->setFrom([\Yii::$app->params['supportEmail'] => 'OCM-Admin'])
                                 ->setTo($e1)
                                 ->setSubject('Budget allocated')
                                 ->send();
//            if($response){
//                $modelmail = new Maillog();		
//                $modelmail->to = $e1;
//                          $modelmail->sub=('expenditure status of entry -'.$model->id);
//                          $modelmail->msg = ('id='.$model->id .
//                            ', dep_id='.$model->dep_id.
//                            ', year='.$model->finance_year.
//                            ', bh_name='.$model->bh_name.
//                            ', bill_no='.$model->bill_no.
//                            ', bill_date='.$model->bill_date.
//                            ', bill_diary_no='.$model->bill_diary_no.
//                            ', status='.$model->status.
//                            ', remark='.$model->remark.''
//                            );
//                        //var_dump($modelmail);
//                          $res = $modelmail->save();
//                         // var_dump($res);die;
//                      }    
//                
//                
//                
          /*************************Mail-end******************************/
                
            foreach ($model as $item){
                $item->save(FALSE);
              }
              $modelocr = new OcrEntry();
                        $modelocr->dep_id = $model[0]->dep_id;
                        $modelocr->finance_year = $model[0]->year;
                        $modelocr->opening_ammount = $ocrsum;
                        $modelocr->avail_bal = $ocrsum;
                        $modelocr->total_expend = NULL;
                        $modelocr->user_id = $model[0]->user_id;
                        $modelocr->source_ip = $model[0]->source_ip;
                        //var_dump($modelocr);die;
                         $modelocr->save(FALSE);
              $modelstatus = array();
              $modelstatus[] = new BudgetHeadStatus();
                
                foreach($rows as $i => $row){
                $modelstatus[] = new BudgetHeadStatus();
                $modelstatus[$i]->year = $model[$i]->year ;
                $modelstatus[$i]->dep_id = $model[$i]->dep_id ;
                $modelstatus[$i]->bh_name = $model[$i]->budget_head ;
                $modelstatus[$i]->bh_total_amount = $model[$i]->bh_netfund ;            
                $modelstatus[$i]->bh_balance = $model[$i]->bh_netfund ;              
                $modelstatus[$i]->save();
                }
              
               return $this->redirect(['index']);
            }
              else{
             foreach($postData as $i => $single){
               $model[$i] = new Budget();
               $model[$i]->setAttributes($single);
           }

            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
            
    }
        }
//        else{
//           
//            return $this->refresh();
//        }
           
          return $this->render('create', [
                'model' => $model,
                
            ]);
    }

    /**
     * Updates an existing Budget model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Budget model.
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
     * Finds the Budget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Budget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Budget::findOne($id)) !== null) {
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
