<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use mPDF;

class SiteController extends Controller
{
   
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
           return $this->redirect(Yii::$app->request->BaseUrl.'/index.php/user/login');
        }
        else{
            if( Yii::$app->user->can("admin")){
                return $this->redirect('admin');
            }
            else{
            return $this->render('index');
            }
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionAdmin()
    {if (\Yii::$app->user->isGuest) {
           return $this->redirect(Yii::$app->request->BaseUrl.'/index.php/user/login');
        }
        else{
            if( Yii::$app->user->can("admin")){
                return $this->render('adminindex');
            }
            else{
               throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
            }
        }
    }
//    public function actionNot(){
//        $rown =(new \yii\db\Query())
//            ->select('*')
//           ->from('expenditure_tbl') 
//            ->where(['outstnd_adv'=>'expenditure', 'status'=>'0'])
//            ->all();
//        if ($rown == NULL){
//            echo "sorry";
//        }
//        else{
//    $key=0;
//    foreach ($rown as $key=>$row){}$key++;
//   
//    echo $key;
//        }
//    }
    public function actionNotification(){
        $x = array();
        $rown =(new \yii\db\Query())
            ->select('*')
           ->from('expenditure_tbl') 
            ->where(['outstnd_adv'=>'Advance', 'advance_status'=>0, 'status'=>0])
            ->all();
        if (empty($rown) ){
            $ad = "sorry";
        }
        else{
            $key=0;
            foreach ($rown as $key=>$row){}$key++;
            $ad = $key;
        }
         $x['advance']= $ad;
         
         
         $rown =(new \yii\db\Query())
            ->select('*')
           ->from('budget_transfer') 
            ->where(['status'=>'pending'])
            ->all();
        if ($rown == NULL){
            $bud = "sorry";
        }
        else{
            $key=0;
            foreach ($rown as $key=>$row){}$key++;
   
        $bud = $key;
        }
            $x['budget']= $bud;
            
            
            $rown =(new \yii\db\Query())
                ->select('*')
                ->from('expenditure_tbl') 
                ->where(['advance_status'=>1, 'status'=>'0'])
                ->all();
            if ($rown == NULL){
                $ex ="sorry";
            }
            else{
                 $key=0;
                  foreach ($rown as $key=>$row){}$key++;   
                 $ex =$key;
             }
            $x['expense']= $ex;
             echo json_encode($x);
        
    }
    
//    public function actionNotad(){
//         
//        $rown =(new \yii\db\Query())
//            ->select('*')
//           ->from('expenditure_tbl') 
//            ->where(['outstnd_adv'=>'Advance', 'advance_status'=>'Unsettled', 'status'=>0])
//            ->all();
//        if (empty($rown) ){
//            echo "sorry";
//        }
//        else{
//    $key=0;
//    foreach ($rown as $key=>$row){}$key++;
//   
//    echo $key;
//        }
//    }
    public function actionNotuser(){
         $id = Yii::$app->user->identity->id;
        $rown =(new \yii\db\Query())
            ->select('*')
           ->from('expenditure_tbl') 
            ->where(['outstnd_adv'=>'Expenditure', 'status'=>'3', 'dep_id'=>$id])
            ->all();
        if (empty($rown) ){
            echo "sorry";
        }
        else{
    $key=0;
    foreach ($rown as $key=>$row){}$key++;
   
    echo $key;
        }
    }
//    public function actionNotbud(){
//        $rown =(new \yii\db\Query())
//            ->select('*')
//           ->from('budget_transfer') 
//            ->where(['status'=>'pending'])
//            ->all();
//        if ($rown == NULL){
//            echo "sorry";
//        }
//        else{
//    $key=0;
//    foreach ($rown as $key=>$row){}$key++;
//   
//    echo $key;
//        }
//    }
    public function actionQuerybh($yr,$id){
        $x='';
       $x .='<option value="all" id ="bh_all">All </option>'; 
        $no =0;
        $id = $_REQUEST["id"];
        $q = $_REQUEST["yr"];
    $rown =(new \yii\db\Query())
            ->select('*')
           ->from('budget') 
            ->where(['year'=>$q, 'dep_id' => $id])
            ->all();
    if(empty($rown)){
    $x = "<option>No Budget Heads</option>";
    }
        foreach($rown as $no => $row){
        $x .='<option value="'. $row['budget_head'].'" id ="bh_'.$row['budget_head'].'">'.$row['budget_head'] .' </option>'; 
           
        }
            echo $x;
    }
    
    
     public function actionReportuser(){
         
         return $this->render('reportuser');
         
     }
      public function actionReportadmin($id){
         
         return $this->render('reportadmin',['id'=>$id]);
         
     }
     public function actionPdf($id, $yr){
            $mpdf = new mPDF;
            $mpdf->setFooter('Powered By: IIC-PNS');
            //$mpdf->SetWatermarkText('IIC-PNS', 0.08);
            $mpdf->showWatermarkImage = true;
            
            $mpdf->watermark_font = 'Helvetica';
            $mpdf->SetHeader('OCM Report||{PAGENO}');
            $mpdf->WriteHTML('<watermarkimage src="du_seal.png" alpha="0.05" size="200,200" />');
            $mpdf->WriteHTML( $this->render('reportadminpdf',['id'=>$id, 'yrpdf'=>$yr]));
            $mpdf->Output();
            exit;

    }
  
    public function actionMasterReportAdmin($id){
        
        
        return $this->render('masterreport',['id'=>$id]);
       
    }
    public function actionMasterReport(){
        
        
        return $this->render('masterreport');
       
    }
    public function actionMasterReportpdf($hl,$hc, $hr,$fl,$fr,$depid,$year,$ex,$ex0,$ex1,$ex2,$ex3,$ex4,$ex5,$ex6,$ex7, $oc,$oc0,$oc1,$oc2,
                $bh, $bh0,$bh1,$bh2, $ad,$ad0,$ad1,$ad2,$ad3,$ad4,$ad5){
              
        
        $hl =  $_REQUEST["hl"]; 
        $hc =  $_REQUEST["hc"]; 
        $hr =  $_REQUEST["hr"]; 
        $fl =  $_REQUEST["fl"]; 
       // $fc =  $_REQUEST["fc"]; 
        $fr =  $_REQUEST["fr"]; 
        if($hl){$hlp = $hl;}else{$hlp="OCM Report";}
        if($hc){$hcp = $hc;}else{$hcp="";}
        $date="Date:";
        $date .= date('d-m-Y');
        if($hr){$hrp = $hr;}else{$hrp="";}
        if($fl){$flp = $fl;}else{$flp=$date;}
       // if($fc){$fcp = $fc;}else{$fcp="";}
        if($fr){$frp = $fr;}else{$frp="Powered By: IIC-PNS";}
       
         $mpdf = new mPDF;
            $mpdf->SetHTMLFooter(
                    '<div style=" border-top:1px solid black"><table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
<td width="33%"><span style="font-weight: bold; font-style: italic;">'.$flp.'</span></td>
<td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
<td width="33%" style="text-align: right; ">'.$frp.'</td>
</tr></table></div>'
                    );
//            $mpdf->SetWatermarkText('IIC-PNS', 0.08);
            $mpdf->showWatermarkImage = true;
            $mpdf->watermark_font = 'Helvetica';
            $mpdf->SetHTMLHeader(
                    '<div style=" border-bottom:1px solid black"><table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
<td width="33%"><span style="font-weight: bold; font-style: italic;">'.$hlp.'</span></td>
<td width="33%" align="center" style="font-weight: bold; font-style: italic;">'.$hcp.'</td>
<td width="33%" style="text-align: right; ">'.$hrp.'</td>
</tr></table></div>'
                    );
           
          $mpdf->WriteHTML('<watermarkimage src="du_seal.png" alpha="0.05" size="200,200" />');
           $mpdf->WriteHTML( 
           $this->render('masterreportpdf',['print'=>$print,'id'=>$depid,'yrpdf'=>$year,'ex'=>$ex,'ex0'=>$ex0,'ex1'=>$ex1,
            'ex2'=>$ex2,'ex3'=>$ex3,'ex4'=>$ex4,'ex5'=>$ex5,'ex6'=>$ex6,'ex7'=>$ex7,'oc'=> $oc,'oc0'=>$oc0,'oc1'=>$oc1,'oc2'=>$oc2,
             'bh'=>$bh,'bh0'=> $bh0,'bh1'=>$bh1,'bh2'=>$bh2,'ad'=> $ad,'ad0'=>$ad0,'ad1'=>$ad1,'ad2'=>$ad2,'ad3'=>$ad3,'ad4'=>$ad4,'ad5'=>$ad5])
             );
          $mpdf->Output();
            exit;        
    }
    
        public function actionMt($print,$depid,$year,$ex,$ex0,$ex1,$ex2,$ex3,$ex4,$ex5,$ex6,$ex7, $oc,$oc0,$oc1,$oc2,
                $bh, $bh0,$bh1,$bh2, $ad,$ad0,$ad1,$ad2,$ad3,$ad4,$ad5,$ad6){
            
          $pr =  $_REQUEST["print"];   
         
        $id =  $_REQUEST["depid"];
        $yrpdf= $_REQUEST["year"];   
        $ex = $_REQUEST["ex"];
        $ex0 = $_REQUEST["ex0"];
        $ex1 = $_REQUEST["ex1"];
        $ex2 = $_REQUEST["ex2"];
        $ex3 = $_REQUEST["ex3"];
        $ex4 = $_REQUEST["ex4"];
        $ex5 = $_REQUEST["ex5"];
        $ex6 = $_REQUEST["ex6"];
        $ex7 = $_REQUEST["ex7"];
        $oc = $_REQUEST["oc"];
        $oc0 = $_REQUEST["oc0"];
        $oc1 = $_REQUEST["oc1"];
        $oc2 = $_REQUEST["oc2"];
        $bh = $_REQUEST["bh"];
        $bh0 = $_REQUEST["bh0"];
        $bh1 = $_REQUEST["bh1"];
        $bh2 = $_REQUEST["bh2"];
        $ad = $_REQUEST["ad"];
        $ad0 = $_REQUEST["ad0"];
        $ad1 = $_REQUEST["ad1"];
        $ad2 = $_REQUEST["ad2"];
        $ad3 = $_REQUEST["ad3"];
        $ad4 = $_REQUEST["ad4"];
        $ad5 = $_REQUEST["ad5"];
        $ad6 = $_REQUEST["ad6"];
       
              
              $masterstring="";
      $masterstring .= " <div 'class=col-md-12 grand' style='margin-top:40px;'>";
            $rowocr =(new \yii\db\Query())
                  ->select('*')
                 ->from('ocr_entry') 
                  ->where(['dep_id' => $id, 'finance_year'=>$yrpdf])
                  ->all(); 
    
      $masterstring .= "<div class='box_yr'id='". $yrpdf ."' >
                <div class='headings' style='font-weight: bold; font-size: 1.3em;'>".           
                $yrpdf
                ."</div>";
      
      if($oc == 1){
     $masterstring .= "      <div  style='color:#421c52; background-color: #D9D6FF;  padding:5px;'>OCR Entry</div>
                 <table class='table table-striped table-bordered' >
                    <thead>
                        <tr>";
    if($oc0 ==1){ $masterstring .= "     <th>Amount</th>";}
    if($oc1 ==1){  $masterstring .= "     <th>Expenditure</th>";}
    if($oc2 ==1){  $masterstring .= "     <th>Balance</th>";}            
    $masterstring .= "                    </tr>
                    </thead>
                    <tbody>

                        <tr>";
    if($oc0 ==1){  $masterstring .= "     <td>". $rowocr[0]['opening_ammount']." </td>";}
    if($oc1 ==1){  $masterstring .= "     <td>". $rowocr[0]['total_expend']." </td>";}
    if($oc2 ==1){  $masterstring .= "     <td>". $rowocr[0]['avail_bal']." </td>";}   
    $masterstring .= "                </tr>

                    </tbody>
                </table>";
      }
      if($bh ==1 || $ex==1 || $ad==1){ 
           $rowbh =(new \yii\db\Query())
                   ->select('*')
                  ->from('budget') 
                   ->where(['dep_id' => $id, 'year'=> $yrpdf])
                   ->all();
        
           
           foreach($rowbh as $yr=>$rowb){
    $masterstring .= "<div class='tbl' id='".$yrpdf.$rowb['budget_head']."'>
            <div  class='headings' style='border-radius: 0px;font-size:1.3em ; background-color: #e6c884; color:#421c52'>". 
            $rowb['budget_head'].
            "</div> ";
                  
            $rowbhs =(new \yii\db\Query())
                   ->select('*')
                   ->from('budget_head_status') 
                   ->where(['dep_id' => $id, 'year'=>$yrpdf,'bh_name'=>$rowb['budget_head']])
                   ->all();
     if( $bh == 1){     
    $masterstring .= "<div  style='color:#000; background-color: #D9D6FF;  padding:5px;'>Budget Head Status</div>
  <table class='table table-striped table-bordered' >
                <thead>
                    <tr>";
  if($bh0 ==1){  $masterstring .= "    <th>Amount</th>";}
  if($bh1 ==1){  $masterstring .= "    <th>Expenditure</th>";}
  if($bh2 ==1){  $masterstring .= "    <th>Balance</th> ";}           
   $masterstring .= "            </tr>
                </thead>
                <tbody>

                    <tr>";
 if($bh0 ==1){  $masterstring .= "   <td>". $rowbhs[0]['bh_total_amount']."  </td>";}
 if($bh1 ==1){  $masterstring .= "   <td>". $rowbhs[0]['bh_expend']."  </td>";}
 if($bh2 ==1){  $masterstring .= "   <td>". $rowbhs[0]['bh_balance']."  </td>";}   
     $masterstring .= "          </tr>

                </tbody>
            </table>";
     }
            $rowex =(new \yii\db\Query())
                       ->select('*')
                      ->from('expenditure_tbl') 
                       ->where(['dep_id' => $id, 'finance_year'=> $yrpdf, 'bh_name'=>$rowb['budget_head']])
                       ->all();
       if( $ex == 1){           
    $masterstring .= "<div style='color:#421c52; background-color: #D9D6FF/*#23527c*/;  padding:5px;'>Expenditure Report</div>
        <table class='table table-striped table-bordered' >
        <thead>
            <tr><th>#</th>
                <th>Entry no.</th>";
  if($ex0 ==1){  $masterstring .= " <th>Bill Date</th>";}
  if($ex1 ==1){  $masterstring .= " <th>Bill No.</th>";}
  if($ex2 ==1){  $masterstring .= " <th>Bill Diary No.</th>";}
  if($ex3 ==1){  $masterstring .= " <th>Amount</th>";}
  if($ex4 ==1){  $masterstring .= " <th>Payment Information</th>";}
  if($ex5 ==1){  $masterstring .= " <th>Description</th>";}
  if($ex6 ==1){  $masterstring .= " <th>satus</th>";}
  if($ex7 ==1){  $masterstring .= " <th>Remark</th>";}

 $masterstring .= "      </tr>
        </thead>
        <tbody>";
            foreach($rowex as $no=>$rowe){ 
                $key = $no;
                $key++;
    $masterstring .= "   <tr>  
        <td>".$key ." </td>
                <td>". $rowe['id']." </td>";
  if($ex0 ==1){  $masterstring .= "   <td>". $rowe['bill_date']." </td>";}
  if($ex1 ==1){  $masterstring .= "   <td>". $rowe['bill_no']." </td>";}
  if($ex2 ==1){  $masterstring .= "   <td>". $rowe['bill_diary_no']." </td>";}
  if($ex3 ==1){  $masterstring .= "   <td>". $rowe['bill_amount']." </td>";}
  if($ex4 ==1){  $masterstring .= "   <td>". $rowe['payment_info']." </td>";}
  if($ex5 ==1){  $masterstring .= "   <td>". $rowe['desc']." </td>";}
  if($ex6 ==1){  $masterstring .= "   <td>";
                            if($rowe['status'] == 0) $masterstring .= "Pending";
                            if($rowe['status'] == 1) $masterstring .= "Approved";
                            if($rowe['status'] == 2) $masterstring .= "Rejected";
                            if($rowe['status'] == 3) $masterstring .= "Returned with objection";
                             $masterstring .=" </td>";}
  if($ex7 ==1){  $masterstring .= "   <td>". $rowe['remark']." </td>";}
   $masterstring .= "    </tr>";
         } 
    $masterstring .= "</tbody>
        </table>
       </div>  "; }            
             
        
       $rowadv =(new \yii\db\Query())
                       ->select('*')
                      ->from('expenditure_tbl') 
                       ->where(['dep_id' => $id, 'finance_year'=> $yrpdf, 
                           'bh_name'=>$rowb['budget_head'],'outstnd_adv'=>'Advance'])
                       ->all();
              
       if( $ad == 1){ 
        $masterstring .= "<div style='color:#421c52; background-color: #D9D6FF/*#23527c*/;  padding:5px;'>Advances</div>
        <table class='table table-striped table-bordered' >
        <thead>
            <tr>
            <td>#</td>";
if($ad0 ==1){  $masterstring .= "                 <th>Entry no.</th>";}
if($ad1 ==1){  $masterstring .= "                <th>Budget Head</th>";}
if($ad2 ==1){  $masterstring .= "                <th>Amount</th>";}
if($ad3 ==1){  $masterstring .= "                <th>Drawn on</th>";}
if($ad4 ==1){  $masterstring .= "                <th>Settled on</th>";}
if($ad5 ==1){  $masterstring .= "                <th>Status</th>";}
if($ad6 ==1){  $masterstring .= "                <th>Advance Status</th>";}

 $masterstring .= "           </tr>
        </thead>
                <tbody>";
        foreach($rowadv as $no=>$rowad){ 
            $key=$no;
            $key++;
    $masterstring .= "   <tr> <td>".$key."</td> ";        
if($ad0 ==1){  $masterstring .= "                <td>". $rowad['id']." </td>";}
if($ad1 ==1){  $masterstring .= "                <td>". $rowad['bh_name']." </td>";}
if($ad2 ==1){  $masterstring .= "                <td>". $rowad['bill_amount']." </td>";}
if($ad3 ==1){  $masterstring .= "                <td>". $rowad['drawn_on']." </td>";}
if($ad4 ==1){  $masterstring .= "                <td>". $rowad['settled_on']." </td>";}
if($ad5 ==1){  $masterstring .= "                <td>"; 
        
        if($rowad['status']=='0'){ $masterstring .="Pending";}
        if($rowad['status']=='1'){ $masterstring .="Approved";}
        if($rowad['status']=='2'){ $masterstring .="Rejected";}
        if($rowad['status']=='3'){ $masterstring .="Returned with Objection";}
               $masterstring .= " </td>";}
if($ad6 ==1){  $masterstring .= "                <td>";
        if($rowad['advance_status']=='0'){$masterstring .="Unsettled";}
        if($rowad['advance_status']=='1'){$masterstring .="Settled";}
        $masterstring .=" </td>";}
 $masterstring .= "           </tr>";
         } 
    $masterstring .= "</tbody>
       </table>
       </div>  "; 
            
 }            
       
       
        
      }}
$masterstring .= " </div><br>

</div>
";
if($pr){   
     $mpdf = new mPDF;
            $mpdf->setFooter('Powered By: IIC-PNS');
            $mpdf->SetWatermarkText('IIC-PNS', 0.08);
            $mpdf->showWatermarkText = true;
            $mpdf->watermark_font = 'Helvetica';
            $mpdf->SetHeader('OCM Report||{PAGENO}');
          
           $mpdf->WriteHTML($masterstring);
          $mpdf->Output();
            exit;  
         }
         else{
   echo  $masterstring;    

         }    
        
    }
                   
    public function actionGsearch($x){
        $x = $_REQUEST["x"]; 
        $y = array();
       
        if ($x == 'qwe@'){
          echo ' '; 
        }
        else{
          
            if (($x == 'Settled') || ($x == 'settled')){
              $x=1;
            }
            if(($x == 'approved') || ($x == 'Approved')){
                $x=1;
            }
            if(($x == 'pending') || ($x == 'Pending')){
                $x=0;
            }
            $rown =(new \yii\db\Query())
                ->select('*')
                ->from('expenditure_tbl') 
                ->where(['like', 'bh_name', $x])
                ->orwhere(['like', 'desc', $x])
                ->orwhere(['like', 'id', $x])
                ->orwhere(['like', 'status', $x])
                ->orwhere(['like', 'advance_status', $x])
                ->orwhere(['like', 'finance_year', $x])
                ->orwhere(['like', 'bill_date', $x])
                ->orwhere(['like', 'bill_diary_no', $x])
                ->orwhere(['like', 'outstnd_adv', $x])
                ->orwhere(['like', 'remark', $x])
                ->orwhere(['like', 'drawn_on', $x])
                ->orwhere(['like', 'settled_on', $x])
                ->orwhere(['like', 'bill_no', $x])
                ->all();
            $rowm =(new \yii\db\Query())
                ->select('*')
                ->from('advance_settle') 
               
                ->orwhere(['like', 'bill_no', $x])
                ->orwhere(['like', 'bill_diary', $x])
                ->orwhere(['like', 'bill_date', $x])
                ->orwhere(['like', 'bill_amount', $x])
                
                ->orwhere(['like', 'vendor_details', $x])
                ->orwhere(['like', 'remarks', $x])
                ->all();
            $y['exp'] = $rown;
            $y['set'] = $rowm;
            echo json_encode($y);
        }
    }
    public function actionMap(){
	 if( Yii::$app->user->can("admin")){
       		 return $this->render('map');
	}
	else{
		throw new \yii\web\ForbiddenHttpException("You are not allowed to perform this action.");
	}
        
    }
    
    public function actionMapquery($dep, $yr){
        $exp=array();
        $adv=array();
        $rowbh =(new \yii\db\Query())
                               ->select('*')
                               ->from('budget_head_status')    
                              ->all();
       foreach($rowbh as $key=>$row){
           
           
       }
     $dep = $_REQUEST['dep'];
	$yr = $_REQUEST['yr'];

     if( $dep == 'all'){
         $rowex =(new \yii\db\Query())
                               ->select('*')
                               ->from('expenditure_tbl') 
				->where(['finance_year'=>$yr])   
                              ->all();
     }
       else{ 
        $rowex =(new \yii\db\Query())
                               ->select('*')
                               ->from('expenditure_tbl')    
                               ->where(['dep_id'=>$dep, 'finance_year'=>$yr])
                               ->all();
       }
        $exp[0]='Expenditure';
        $adv[0]='Advance';
        
        for($i=1;$i<=12;$i++){
            $exp[$i]=0;
             $adv[$i]=0;
        }
        foreach($rowex as $key=>$row){
            if($row['outstnd_adv'] == 'Advance'){
                    $str = $row['drawn_on'];
                     $i=0;
                $i=substr($str,3,2);
                $j=substr($str,3,1);
              
                    if($j==0){
                        $i=substr($str,4,1);
                    }
			if($i>=1 && $i <=3){ $i = $i+9; }
			else {$i = $i-3; }

                $a=0;$b=0;
                $a=$adv[$i];
                $b=(int)$row['bill_amount'];

                $adv[$i] = $a+$b;
            }
            else{
                $str = $row['bill_date'];
                 $i=0;
                $i=substr($str,3,2);
              
                $j=substr($str,3,1);
               
                    if($j==0){
                        $i=substr($str,4,1);
                    }
			if($i <4){ $i = $i+9; }
			else{$i = $i-3; }

                $a=0;$b=0;
                $a=$exp[$i];
                $b=(int)$row['bill_amount'];

                $exp[$i] = $a+$b;
            }

           


        }
             $arr= array();
             $arr['Expenditure']=$exp;
             $arr['Advance']=$adv;
              echo json_encode($arr);
    }
    
    public function actionMapbhquery($dep, $typ, $yr){
         $dep = $_REQUEST['dep'];
         $typ = $_REQUEST['typ'];
        $exp=array(array());
      //  $adv=array(array());
         $arr= array(array());
    
     if( $dep ==NULL){
        
         $rowbh =(new \yii\db\Query())
                               ->select('*')
                               ->from('budget_heads') 
			      
                               ->all();
     }
       else{
        $rowbh =(new \yii\db\Query())
                               ->select('*')
                               ->from('budget_head_status') 
                               ->where(['dep_id'=>$dep, 'year'=>$yr])
                               ->all();
            
       }$i=0;
       foreach($rowbh as $key=>$row){
           $i =$key+1;
               $arr[$i][0]=$row['bh_name'];
            }$i++;
           $arr[$i][0]='Average'; 
        foreach($rowbh as $key=>$row){
            $j=$key+1;
            for($i=1;$i<=12;$i++){
                $arr[$j][$i]=0;
            
            }
        }
        $j++;
        for($i=1;$i<=12;$i++){
                $arr[$j][$i]=0;
            
            }
        //var_dump($exp);die;
        foreach($rowbh as $key=>$row){
            
            if( $dep ==NULL){
                if($typ=='all'){
                    $rowex =(new \yii\db\Query())
                                      ->select('*')
                                      ->from('expenditure_tbl') 
                                      ->where(['bh_name'=>$row['bh_name'] ,'finance_year'=>$yr])
                                      ->all();
                }
                else{
                $rowex =(new \yii\db\Query())
                                      ->select('*')
                                      ->from('expenditure_tbl') 
                                      ->where(['outstnd_adv'=>$typ,'bh_name'=>$row['bh_name'], 'finance_year'=>$yr])
                                      ->all();
                }

            }
            else{
                if($typ=='all'){
                $rowex =(new \yii\db\Query())
                                       ->select('*')
                                       ->from('expenditure_tbl')    
                                       ->where(['dep_id'=>$dep,'bh_name'=>$row['bh_name'],'finance_year'=>$yr])
                                       ->all();
                }
                else{
                    $rowex =(new \yii\db\Query())
                                       ->select('*')
                                       ->from('expenditure_tbl')    
                                       ->where(['dep_id'=>$dep, 'outstnd_adv'=>$typ,'bh_name'=>$row['bh_name'],'finance_year'=>$yr])
                                       ->all();
                }


            }
            $index=$key+1;
            foreach($rowex as $no=>$rowx){
                if($rowx['outstnd_adv'] == 'Advance'){
                    $str = $rowx['drawn_on'];
                }
                 else{
                    $str = $rowx['bill_date'];
                 }
                    $i=0;
                     $i=substr($str,3,2);
                     $j=substr($str,3,1);

                    if($j==0){
                        $i=substr($str,4,1);
                    }
			if($i>=1 && $i <=3){ $i = $i+9; }
			else {$i = $i-3; }

                    $a=0;$b=0;
                    $a=$arr[$index][$i];
                    $b=(int)$rowx['bill_amount'];

                    $arr[$index][$i] = $a+$b;
                   // var_dump($arr[$index][$i]);die;
                }
            
            }
            foreach ($rowbh as $key => $value) {
                
            }$key++; /// $key is no. of budget heads
            $r=$key+1;
            
            for($i=1;$i<=12;$i++){
                $sum=0;
                for($j=1;$j<=$key;$j++){
                    $q=0;$w=0;
                    $q = $sum;
                    $w = $arr[$j][$i];
                    $sum = $q + $w;
                }
               $arr[$r][$i]= $sum/$key;
            }
            


            
             $x=array();
             $x= ['x', 'April', 'May','June', 'July', 'August', 'September', 'October','November','December','January', 'February', 'March'];
              $arr[0]=$x;

          // echo $typ;
              echo json_encode($arr);
    }
   
}

