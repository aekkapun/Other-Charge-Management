<?php

namespace app\controllers;

use Yii;
use app\models\AdvanceSettle;
use app\models\Expenditure;
use app\models\ExpenditureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\BudgetHeadStatus;
use app\models\OcrEntry;
use app\models\Log;
use app\models\Maillog;
use app\models\Advance;

/**
 * ExpenditureController implements the CRUD actions for Expenditure model.
 */
class ExpenditureController extends Controller
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
     * Lists all Expenditure models.
     * @return mixed
     */
    public function actionIndex()
    {  if( Yii::$app->user->can("admin")){
        $searchModel = new ExpenditureSearch();
        $searchModel->finance_year = $this->yr();
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
    
    public function actionPendingrequest()
    {  if( Yii::$app->user->can("admin")){
        $searchModel = new ExpenditureSearch();
       // $searchModel->outstnd_adv ="Expenditure";
        $searchModel->advance_status ='1';
        $searchModel->status = "0";
        $searchModel->finance_year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('pendingrequest', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
        else{
        throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
    }
    }
    
    public function actionPendingexpends()
    {  
        $searchModel = new ExpenditureSearch();
        $searchModel->dep_id = Yii::$app->user->identity->id;
       $searchModel->advance_status ='1';
        $searchModel->status = "0";
        $searchModel->finance_year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('pendingexpends', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }
    public function actionAllAdvance(){// advance index for admin
        if( Yii::$app->user->can("admin")){
        $searchModel = new ExpenditureSearch();
        $searchModel->outstnd_adv = 'Advance';
       //$searchModel->status = "0";
        $searchModel->finance_year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('alladvanceadmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
        else{
        throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
    }
    }
    public function actionAllAdvanceUser(){// advance index for admin
        
        $searchModel = new ExpenditureSearch();
        $searchModel->dep_id = Yii::$app->user->identity->id;
        $searchModel->outstnd_adv = 'Advance';
       //$searchModel->status = "0";
        $searchModel->finance_year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('alladvanceuser', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }
    
    
     public function actionAdvance()//unsettled advances for mailing
    {  if( Yii::$app->user->can("admin")){
               if(Yii::$app->request->post()){
            if(isset($_POST['email'])){
                $email = explode(',', $_POST['email']);
                 foreach ($email as $e1){
                     if($e1!=''){
                         $response = \Yii::$app->mailer->compose('MailStruct1',['to'=>$e1,'message'=>$_POST['message']])
                                 ->setFrom([\Yii::$app->params['supportEmail'] => 'OCM- Advance alert'])
                                 ->setTo($e1)
                                 ->setSubject($_POST['subject'])
                                 ->send();
                     }


                 }
                 if($response){
                  ?>              
<script type="text/javascriptt">
    alert("mail sent successfully");
</script>

<?php
            }
//             $model1->email=$_POST['email'];
//             $model1->subject=$_POST['subject'];
//             $model1->message=$_POST['message'];
            
            
        }
        }


        
        
        
        $searchModel = new ExpenditureSearch();
        $searchModel->advance_status = '0';
       //$searchModel->status = "0";
        $searchModel->finance_year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('advance', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
        else{
        throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
    }
    }
    
    public function actionUseradvance()
    {  
        $searchModel = new ExpenditureSearch();
       $searchModel->advance_status ='0';
       $searchModel->dep_id = Yii::$app->user->identity->id;
       $searchModel->finance_year = $this->yr();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('useradvance', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }
    
    public function actionUserindex()
    {   
        $searchModel = new ExpenditureSearch();
        $searchModel->dep_id = Yii::$app->user->identity->id;
        $searchModel->finance_year = $this->yr();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('userindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionReturned()
    {   
        $searchModel = new ExpenditureSearch();
        $searchModel->dep_id = Yii::$app->user->identity->id;
        $searchModel->finance_year = $this->yr();
        $searchModel->status = 3;
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('returned', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionQueryup($yr,$dep,$bh){
              $x = array();
            $x1='';
            $q = $_REQUEST["yr"];
            $r = $_REQUEST["dep"];
            $s = $_REQUEST["bh"];
           // if (Yii::$app->user->can('admin')){
            $q= str_replace(' ', '', $q);
           // $s= str_replace(' ', '', $s);
           // $s= preg_replace('/\s\s+/', ' ', $s);
           $s = ltrim($s, " ");
           // }
            $rown =(new \yii\db\Query())
                    ->select('*')
                   ->from('advance') 
                    ->where(['year'=>$q, 'dep_id'=> $r, 'bh_name'=> $s])
                    ->all();
   
            foreach($rown as $no => $row){}
            $rowf=(new \yii\db\Query())
                     ->select('*')
                     ->from('budget_head_status') 
                     ->where(['year'=>$q, 'dep_id'=> $r, 'bh_name'=> $s])
                     ->all();

            $x['amount']= (int)$rowf[0]['bh_total_amount'];
            $x['expend']= (int)$rowf[0]['bh_expend'];
            $x['balance']= (int)$rowf[0]['bh_balance'];
            
            $rowm =(new \yii\db\Query())
                    ->select('*')
                   ->from('expenditure_tbl') 
                    ->where(['finance_year'=>$q, 'dep_id'=> $r, 'bh_name'=> $s, 'outstnd_adv'=>'advance'])
                    ->all();
   
            foreach($rowm as $no => $row){
                if($rowm[$no]['advance_status']==0){
            $rowm[$no]['advance_status']='Unsettled';
        }
        else {
              $rowm[$no]['advance_status']='Settled'; 
        }
                
                $x1 .= '&#10148 Ocr No.'.$rowm[$no]['id'] .'<br>'.'&#8377'
                .'&nbsp'.(int)$rowm[$no]['bill_amount'].'('.$rowm[$no]['advance_status'].')'.'<br><br>';
               // $x1 .= 'hello';
            }
            $x['advance']= $x1;
   
            
            echo json_encode($x);
        
    }
    
   public function actionQueryad($yr,$dep,$bh){
        $x1='';
        $q = $_REQUEST["yr"];
        $r = $_REQUEST["dep"];
        $s = $_REQUEST["bh"];
        
        $rown =(new \yii\db\Query())
            ->select('*')
           ->from('expenditure_tbl') 
            ->where(['finance_year'=>$q, 'dep_id'=> $r, 'bh_name'=>$s, 
                'outstnd_adv'=>'Advance', 'advance_status'=>'0'])
            ->all();
        foreach($rown as $key=>$rowad){
            if($rowad['advance_status']==0){
            $rowad['advance_status']='Unsettled';
            $x1 .= '&#10146; OCR No.'.' '.$rowad['id'].'&#8377;'.' '.$rowad['bill_amount'].' '.'('.$rowad['advance_status'].')'.'<br>';
            }
        }
        echo $x1;
   }
    
    
    public function actionQuery1($yr,$dep){
        //$x = array();
        $x1='';
        $q = $_REQUEST["yr"];
        $r = $_REQUEST["dep"];
   
    $rowbh =(new \yii\db\Query())
            ->select('*')
           ->from('budget_head_status') 
            ->where(['year'=>$q, 'dep_id'=> $r])
            ->all();

    foreach($rowbh as $no => $row){
       // var_dump($row['bh_name']);die;
        $rown =(new \yii\db\Query())
            ->select('*')
           ->from('expenditure_tbl') 
            ->where(['finance_year'=>$q, 'dep_id'=> $r, 'bh_name'=>$row['bh_name'], 'outstnd_adv'=>'Advance'])
            ->all();
        
        $x1 .= '<div class="col-md-12">'.
                '<div class="col-md-2" style="color:maroon">'
                .$row['bh_name'].
                '</div>'.
                '<div class="col-md-2" style="color:green">'
               .$row['bh_total_amount'].
                '</div>'.
                '<div class="col-md-2" style="color:orange">'
               .$row['bh_expend'].
                '</div>'.
                '<div class="col-md-2" style="color:blue">'
               .$row['bh_balance'].             
                '</div>'.
                 '<div class="col-md-4" style="color:red">';
        
        foreach($rown as $key=>$rowad){
            if($rowad['advance_status']==0){
            $rowad['advance_status']='Unsettled';
            $x1 .= 'OCR No.'.' '.$rowad['id'].'- '.'&#8377; ' .$rowad['bill_amount'].' '.'('.$rowad['advance_status'].')'.'<br>';
            }
           
            
            
        }
       $x1 .= '</div></div>';
        
    }
   
            echo $x1;
    }
    
    public function actionQuery($yr,$dep,$bh){
         $x = array();
        $q = $_REQUEST["yr"];
    $r = $_REQUEST["dep"];
    $s = $_REQUEST["bh"];
    $s = ltrim($s, " ");
    $r = ltrim($r, " ");
    $rown =(new \yii\db\Query())
            ->select('*')
           ->from('advance') 
            ->where(['year'=>$q, 'dep_id'=> $r, 'bh_name'=> $s])
            ->all();
   // var_dump($rown);die;
    foreach($rown as $no => $row){}
   $rowf=(new \yii\db\Query())
            ->select('*')
            ->from('budget_head_status') 
            ->where(['year'=>$q, 'dep_id'=> $r, 'bh_name'=> $s])
            ->all();

            $x['amount']= (int)$rowf[0]['bh_total_amount'];
            $x['expend']= (int)$rowf[0]['bh_expend'];
            $x['balance']= (int)$rowf[0]['bh_balance'];
            echo json_encode($x);
    }

    /**
     * Displays a single Expenditure model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
       // $model = new Expenditure();
        $model = $this->findModel($id);
            
        if($model->outstnd_adv == 'Advance' && ($model->status ==1 ) && $model->advance_status == 1){
            return $this->render('viewadvance', [
            'model' => $model,
               
            ]);
        }
        if($model->outstnd_adv == 'Advance' && $model->status !=1 && $model->advance_status == 1){
            return $this->render('viewsetadv', [
            'model' => $model,
            ]);
        }
        return $this->render('viewexp', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Expenditure model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         $model = array();
        $model[] = new Expenditure();
//        $model->dep_id = Yii::$app->user->identity->id;
//        $model->user_id = Yii::$app->user->identity->id;
//        $model->source_ip = Yii::$app->request->userIP;
//        $model->status = '0';
//        $model->outstnd_adv = 'Expenditure';
//        $model->advance_status ='1';
//        $model->finance_year = $this->yr();
//        $modelset = array();
//        $modelset[] = new AdvanceSettle; 
        

          $postData = Yii::$app->request->post('Expenditure');
                if ($postData !== null && is_array($postData)) {
                    $model = array();
                    foreach ($postData as $i => $single) {
                        $model[$i] = new Expenditure();
                                $model[$i]->dep_id = Yii::$app->user->identity->id;
                                $model[$i]->user_id = Yii::$app->user->identity->id;
                                $model[$i]->source_ip = Yii::$app->request->userIP;
                                $model[$i]->status = '0';
                                $model[$i]->outstnd_adv = 'Expenditure';
                                $model[$i]->advance_status ='1';
                                $model[$i]->finance_year = $this->yr();

                    }
                }
        if (Expenditure::loadMultiple($model, Yii::$app->request->post()) &&
                   Expenditure::validateMultiple($model)){
             
                    foreach ($model as $item) {
                        //var_dump($item->bh_name);
           //   var_dump($model[1]->bh_name);
                        $bal = 0;
                        $am =0;
                         $rowf=(new \yii\db\Query())
                            ->select('*')
                            ->from('budget_head_status') 
                            ->where(['year'=>$item->finance_year, 'dep_id'=> $item->dep_id,
                                'bh_name'=> $item->bh_name])
                            ->all();
                  //  var_dump($rowf);
                        $bal = (int)$rowf[0]['bh_balance'];
                        $am = (int)$item->bill_amount;
                         if ($bal>$am){
                         //   var_dump($bal);
                           //  var_dump($am);
                             //var_dump($item);
                            $item->save(false);
                            
                            $modellog = new Log();            
                $modellog->dep_id = $item->dep_id;
                $modellog->finance_year = $item->finance_year;
                $modellog->bh_name = $item->bh_name;
                $modellog->bill_amount = $item->bill_amount;
                $modellog->bill_date = $item->bill_date;
                $modellog->bill_no = $item->bill_no;
                $modellog->bill_diary_no = $item->bill_diary_no;
                $modellog->payment_info = $item->payment_info;
                $modellog->desc = $item->desc;
                $modellog->outstnd_adv = $item->outstnd_adv;
                $modellog->status = $item->status;
                $modellog->remark = $item->remark;
                $modellog->source_ip = $item->source_ip;
                $modellog->user_id = $item->user_id;
                $modellog->save();
               //  return $this->redirect(['view', 'id' => $item->id]);
                        }
                        else{
                            Yii::$app->session->setFlash('contactFormSubmitted');
                             return $this->refresh();
                        }
           
                        
                       
                    }
                 
               return $this->redirect(['userindex']);
            }
            
  

        else {
            return $this->render('create', [
                'model' => $model,
               
            ]);
        }
    }

    /**
     * Updates an existing Expenditure model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   if( Yii::$app->user->can("admin")){
        $model = $this->findModel($id);
        $model->user_id = Yii::$app->user->identity->id;
        $model->source_ip = Yii::$app->request->userIP;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $rowe=(new \yii\db\Query())
                    ->select('dep_email')
                    ->from('dept_details') 
                    ->where(['dept_id'=> $model->dep_id])
                    ->all();   
            $e1 = $rowe[0]['dep_email'];
            
            $response = \Yii::$app->mailer->compose('MailStruct',
                        ['to'=>$e1,
                            'id'=>$model->id, 
                            'dept_id' => $model->dep_id,
                            'year' => $model->finance_year,
                            'bh_name' => $model->bh_name,
                            'bill_no' => $model->bill_no,
                            'bill_date' => $model->bill_date,
                            'bill_diary' => $model->bill_diary_no,
                            'status' => $model->status,
                            'remark' => $model->remark,
                            ])
                                 ->setFrom([\Yii::$app->params['supportEmail'] => 'OCM-Admin'])
                                 ->setTo($e1)
                                 ->setSubject('expenditure status of entry -'.$model->id)
                                 ->send();
            if($response){
                $modelmail = new Maillog();		
                $modelmail->to = $e1;
                          $modelmail->sub=('expenditure status of entry -'.$model->id);
                          $modelmail->msg = ('id='.$model->id .
                            ', dep_id='.$model->dep_id.
                            ', year='.$model->finance_year.
                            ', bh_name='.$model->bh_name.
                            ', bill_no='.$model->bill_no.
                            ', bill_date='.$model->bill_date.
                            ', bill_diary_no='.$model->bill_diary_no.
                            ', status='.$model->status.
                            ', remark='.$model->remark.''
                            );
                        //var_dump($modelmail);
                          $res = $modelmail->save();
                         // var_dump($res);die;
                      }
            

//var_dump($e1);die;
            
            $modellog = new Log();
           
            $modellog->dep_id = $model->dep_id;
            $modellog->finance_year = $model->finance_year;
            $modellog->bh_name = $model->bh_name;
            $modellog->bill_amount = $model->bill_amount;
            $modellog->bill_date = $model->bill_date;
            $modellog->bill_no = $model->bill_no;
            $modellog->bill_diary_no = $model->bill_diary_no;
            $modellog->payment_info = $model->payment_info;
            $modellog->desc = $model->desc;
            $modellog->outstnd_adv = $model->outstnd_adv;
            $modellog->status = $model->status;
            $modellog->remark = $model->remark;
            $modellog->source_ip = $model->source_ip;
            $modellog->user_id = $model->user_id;
            $modellog->save();
           
                    
            if($model->status == 1 && $model->outstnd_adv == 'Expenditure'  ||
                    $model->status == 1 && $model->outstnd_adv == 'Advance' && $model->advance_status == 1)
            {   
                $modelbhstatus = new BudgetHeadStatus();
                $rowf=(new \yii\db\Query())
                    ->select('*')
                    ->from('budget_head_status') 
                    ->where(['year'=>$model->finance_year, 'dep_id'=> $model->dep_id, 'bh_name' => $model->bh_name])
                    ->all();
                 $modelbhstatus = BudgetHeadStatus::findOne($rowf[0]['id']);
                 $modelbhstatus->bh_expend = (float)$modelbhstatus->bh_expend + (float)$model->bill_amount;
                 $modelbhstatus->bh_balance = (float)$modelbhstatus->bh_balance - (float)$model->bill_amount;
                 $modelbhstatus->bh_advance = $modelbhstatus->bh_advance + (float)$model->outstnd_adv;
                 $modelbhstatus->save(FALSE);
                 
                 $modelocrentry = new OcrEntry();
                 $rowo=(new \yii\db\Query())
                    ->select('id')
                    ->from('ocr_entry') 
                    ->where(['finance_year'=>$model->finance_year, 'dep_id'=> $model->dep_id])
                    ->all();
                 $modelocr = OcrEntry::findOne($rowo[0]['id']);
                 $modelocr->total_expend = (float)$modelocr->total_expend + (float)$model->bill_amount;
                 $modelocr->avail_bal = (float)$modelocr->avail_bal - (float)$model->bill_amount;
                 $modelocr->save(FALSE);
                 
            //var_dump($modelocr);die;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    else{//userupdate
        $model = $this->findModel($id);
        
        $model->user_id = Yii::$app->user->identity->id;
        $model->source_ip = Yii::$app->request->userIP;
        
        if ($model->outstnd_adv == "Advance" && $model->advance_status == 0 && $model->status == 1){//SETTLEMENT
            
       
                   if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                //var_dump($model->advance_status);
              //  if ($model->outstnd_adv == "Expenditure"){
               
                    $model->status =0;
                    $model->advance_status = '1';
                    $model->settled_on = date("d-m-Y");
          
           
            $modellog = new Log();
           
            $modellog->dep_id = $model->dep_id;
            $modellog->finance_year = $model->finance_year;
            $modellog->bh_name = $model->bh_name;
            $modellog->bill_amount = $model->bill_amount;
            $modellog->bill_date = $model->bill_date;
            $modellog->bill_no = $model->bill_no;
            $modellog->bill_diary_no = $model->bill_diary_no;
            $modellog->payment_info = $model->payment_info;
            $modellog->desc = $model->desc;
            $modellog->outstnd_adv = $model->outstnd_adv;
            $modellog->status = $model->status;
            $modellog->remark = $model->remark;
            $modellog->source_ip = $model->source_ip;
            $modellog->user_id = $model->user_id;
            $modellog->save();
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
            //return $this->redirect(['settlement', 'id' => $model->id]);
        } else {
            return $this->redirect(['set',
                'id' => $model->id,
             
            ]);
  
        
        } 
        
        
        }
        
       
        
        if ($model->outstnd_adv == "Advance"){ //EDIT ADVANCE
           // $modelstl[]= new AdvanceSettle();
            
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                //var_dump($model->advance_status);
              //  if ($model->outstnd_adv == "Expenditure"){
                if ($model->advance_status == "1"){
                    $model->status =0;
                    $model->advance_status = '1';
                    $model->settled_on = date("d-m-Y");
                   
                }
            $model->status = '0';
            $modellog = new Log();
           
            $modellog->dep_id = $model->dep_id;
            $modellog->finance_year = $model->finance_year;
            $modellog->bh_name = $model->bh_name;
            $modellog->bill_amount = $model->bill_amount;
            $modellog->bill_date = $model->bill_date;
            $modellog->bill_no = $model->bill_no;
            $modellog->bill_diary_no = $model->bill_diary_no;
            $modellog->payment_info = $model->payment_info;
            $modellog->desc = $model->desc;
            $modellog->outstnd_adv = $model->outstnd_adv;
            $modellog->status = $model->status;
            $modellog->remark = $model->remark;
            $modellog->source_ip = $model->source_ip;
            $modellog->user_id = $model->user_id;
            $modellog->save();
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
            //return $this->redirect(['settlement', 'id' => $model->id]);
        } else {
            return $this->render('userupdate', [
                'model' => $model,
                //'modelstl' =>$modelstl,
            ]);
        }
            
            
        }
        else{
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {//EXPENDITURE EDIT

            $model->status = '0';
            $modellog = new Log();
           
            $modellog->dep_id = $model->dep_id;
            $modellog->finance_year = $model->finance_year;
            $modellog->bh_name = $model->bh_name;
            $modellog->bill_amount = $model->bill_amount;
            $modellog->bill_date = $model->bill_date;
            $modellog->bill_no = $model->bill_no;
            $modellog->bill_diary_no = $model->bill_diary_no;
            $modellog->payment_info = $model->payment_info;
            $modellog->desc = $model->desc;
            $modellog->outstnd_adv = $model->outstnd_adv;
            $modellog->status = $model->status;
            $modellog->remark = $model->remark;
            $modellog->source_ip = $model->source_ip;
            $modellog->user_id = $model->user_id;
            $modellog->save();
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('userupdate', [
                'model' => $model,
            ]);
        }
        }
        
    }
    }

    /**
     * Deletes an existing Expenditure model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        if(Yii::$app->user->can('admin')){
        return $this->redirect(['index']);
        }
        else{
          return $this->redirect(['userindex']);  
        }
    }

    /**
     * Finds the Expenditure model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Expenditure the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expenditure::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAdminview(){
        
        return $this->render('adminview');
        
    }
    
    public function actionDrawAdvance(){
            $model = array();
            $model[] = new Expenditure();
            
            $postData = Yii::$app->request->post('Expenditure');
                if ($postData !== null && is_array($postData)) {
                    $model = array();
                    foreach ($postData as $i => $single) {
                        $model[$i] = new Expenditure();
                         $model[$i]->dep_id = Yii::$app->user->identity->id;
                        $model[$i]->user_id = Yii::$app->user->identity->id;
                        $model[$i]->source_ip = Yii::$app->request->userIP;
                        $model[$i]->status = '0';
                        $model[$i]->outstnd_adv = 'Advance';
                        $model[$i]->advance_status = '0';
                        $model[$i]->finance_year = $this->yr();
                        $model[$i]->drawn_on = date("d-m-Y");
            
                    }
                }
             if (Expenditure::loadMultiple($model, Yii::$app->request->post()) &&
                   Expenditure::validateMultiple($model)){
                 $am=0;
                  foreach ($model as $key=>$item) {
                      $am += $item->bill_amount;
                  }
             foreach ($model as $item) {
                
                 $rowf=(new \yii\db\Query())
                        ->select('*')
                        ->from('budget_head_status') 
                        ->where(['year'=>$item->finance_year, 'dep_id'=> $item->dep_id, 'bh_name'=> $item->bh_name])
                        ->all();
                $bal = (int)$rowf[0]['bh_balance'];
                if ($bal>$am){
                        $modellog = new Log();            
                        $modellog->dep_id = $item->dep_id;
                        $modellog->finance_year = $item->finance_year;
                        $modellog->bh_name = $item->bh_name;
                        $modellog->bill_amount = $item->bill_amount;
                        $modellog->bill_date = $item->bill_date;
                        $modellog->bill_no = $item->bill_no;
                        $modellog->bill_diary_no = $item->bill_diary_no;
                        $modellog->payment_info = $item->payment_info;
                        $modellog->desc = $item->desc;
                        $modellog->outstnd_adv = $item->outstnd_adv;
                        $modellog->status = $item->status;
                        $modellog->remark = $item->remark;
                        $modellog->source_ip = $item->source_ip;
                        $modellog->user_id = $item->user_id;
                       // $modellog->drawn_on = date("d-m-Y");
                        $modellog->save();
                        $item->save();
                        
                }
                else{
                        Yii::$app->session->setFlash('contactFormSubmitted');
                        return $this->refresh();
                }
                
             }
              return $this->redirect('all-advance-user');
                   }
            else {
                return $this->render('advance_form', [
                    'model' => $model,
                ]);
            }
            
            
            
              
//        $model->dep_id = Yii::$app->user->identity->id;
//           $model->user_id = Yii::$app->user->identity->id;
//           $model->source_ip = Yii::$app->request->userIP;
//           $model->status = '0';
//           $model->outstnd_adv = 'Advance';
//           $model->advance_status = '0';
//           $model->finance_year = $this->yr();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            $model->drawn_on = date("d-m-Y");
//            $bal = 0;
//            $am =0;
//            $rowf=(new \yii\db\Query())
//            ->select('*')
//            ->from('budget_head_status') 
//            ->where(['year'=>$model->finance_year, 'dep_id'=> $model->dep_id, 'bh_name'=> $model->bh_name])
//            ->all();
//            $bal = (int)$rowf[0]['bh_balance'];
//            if ($bal>$am){
//            $modellog = new Log();            
//            $modellog->dep_id = $model->dep_id;
//            $modellog->finance_year = $model->finance_year;
//            $modellog->bh_name = $model->bh_name;
//            $modellog->bill_amount = $model->bill_amount;
//            $modellog->bill_date = $model->bill_date;
//            $modellog->bill_no = $model->bill_no;
//            $modellog->bill_diary_no = $model->bill_diary_no;
//            $modellog->payment_info = $model->payment_info;
//            $modellog->desc = $model->desc;
//            $modellog->outstnd_adv = $model->outstnd_adv;
//            $modellog->status = $model->status;
//            $modellog->remark = $model->remark;
//            $modellog->source_ip = $model->source_ip;
//            $modellog->user_id = $model->user_id;
//           // $modellog->drawn_on = date("d-m-Y");
//            $modellog->save();
//            $model->save();
//            
//            
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//         else{
//            Yii::$app->session->setFlash('contactFormSubmitted');
//            return $this->refresh();
//        }
//        } else {
//            return $this->render('advance_form', [
//                'model' => $model,
//            ]);
//        }
    }
    
    public function actionAdvanceRequest(){
        $searchModel = new ExpenditureSearch();
        $searchModel->outstnd_adv ="Advance";
       //$searchModel->dep_id = Yii::$app->user->identity->id;
       $searchModel->finance_year = $this->yr();
       $searchModel->status = 0;
        $searchModel->advance_status ='0';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('advance_request', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
        
    }
    
     public function actionSet($id){
         $did = $id;
         $modelex = new Expenditure();
         $modelex = Expenditure::findOne($id);
         $model = array();
         $model[] = new AdvanceSettle();

        $postData = Yii::$app->request->post('AdvanceSettle');
         if ($postData !== null && is_array($postData)) {
            $model = array();
            foreach ($postData as $i => $single) {
                $model[$i] = new AdvanceSettle();
              //  $model[$i]->user_id = Yii::$app->user->identity->id;
            }
        }
        if(AdvanceSettle::loadMultiple($model, Yii::$app->request->post()) &&
                AdvanceSettle::validateMultiple($model)) {

        foreach ($model as $item) {
            $item->ocr_no = $did;
           // var_dump($item->ocr_no);die;
                $item->save(false);
            }
            $modelex->status = '0';
            $modelex->advance_status = '1';
            $modelex->settled_on = date('d-m-y');
            $modelex->save();
            return $this->redirect(['view', 'id' => $modelex->id]);
        }
       
      
        return $this->render('set', [
            'model' => $model,
            'modelex' => $modelex,
        ]);
        
        
    }
     public function actionAddmore($id){  
        // var_dump($id);die;
          $modelex = new Expenditure();
         $modelex = Expenditure::findOne($id);
        if(\Yii::$app->getRequest()->getIsAjax()) {
            //this is the post data from the ajax request
            $postData = Yii::$app->request->post('AdvanceSettle');
            if (empty($postData) || !is_array($postData)) {
                throw new HttpException(500, 'An internal server error has occured.');
            }
           
            $model = array();
            //creating existing model instances + setting attributes
            foreach ($postData as $i => $single) {
                $model[$i] = new AdvanceSettle();
                $model[$i]->setAttributes($single);
            }
            //var_dump($model);die;
            //end of creating existing model instances + setting attributes
           
            //creating an additional empty model instance
            $model[] = new AdvanceSettle();
           //var_dump($model);die;
            // it has to be renderAjax in order to include the script validation files
            echo $this->renderAjax('add',[
                'modelex' => $modelex,
                'model'=>$model,
                    ]);
 //           echo $model[0];exit;

        } else {
            throw new HttpException(404, 'Unable to resolve the request: Awards/addmore');
        }
    }
    
    
    public function actionAddmoreex(){  
        // var_dump($id);die;
       
        if(\Yii::$app->getRequest()->getIsAjax()) {
            //this is the post data from the ajax request
            $postData = Yii::$app->request->post('Expenditure');
            if (empty($postData) || !is_array($postData)) {
                throw new HttpException(500, 'An internal server error has occured.');
            }
           
            $model = array();
            //creating existing model instances + setting attributes
            foreach ($postData as $i => $single) {
                $model[$i] = new Expenditure();
                $model[$i]->setAttributes($single);
            }
            //var_dump($model);die;
            //end of creating existing model instances + setting attributes
           
            //creating an additional empty model instance
            $model[] = new Expenditure();
           //var_dump($model);die;
            // it has to be renderAjax in order to include the script validation files
            echo $this->renderAjax('addex',[
                'model' => $model,
               
                    ]);
 //           echo $model[0];exit;

        } else {
            throw new HttpException(404, 'Unable to resolve the request: Awards/addmore');
        }
    }
    
        public function actionAddmoreadv(){  
        // var_dump($id);die;
       
        if(\Yii::$app->getRequest()->getIsAjax()) {
            //this is the post data from the ajax request
            $postData = Yii::$app->request->post('Expenditure');
            if (empty($postData) || !is_array($postData)) {
                throw new HttpException(500, 'An internal server error has occured.');
            }
           
            $model = array();
            //creating existing model instances + setting attributes
            foreach ($postData as $i => $single) {
                $model[$i] = new Expenditure();
                $model[$i]->setAttributes($single);
            }
            //var_dump($model);die;
            //end of creating existing model instances + setting attributes
           
            //creating an additional empty model instance
            $model[] = new Expenditure();
           //var_dump($model);die;
            // it has to be renderAjax in order to include the script validation files
            echo $this->renderAjax('addadv',[
                'model' => $model,
               
                    ]);
 //           echo $model[0];exit;

        } else {
            throw new HttpException(404, 'Unable to resolve the request: Awards/addmore');
        }
    }
    
    public function actionUpdatebill($id){
        $model = new AdvanceSettle();
        $model= $model::findOne($id);
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view',
                'id'=>$model->ocr_no,
            ]);
            
        }
        
         return $this->render('updatebill',[
             'model'=>$model,
             
         ]);
        
        
    }
    public function actionDeletebill($id){
        
        $model = new AdvanceSettle();
        $model= $model::findOne($id);
        $idd = $model->ocr_no;
        $model->delete();
        return $this->redirect(['view', 'id'=>$idd]);
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
