<?php
$masterstring="";

$rowdep =(new \yii\db\Query())
                ->select('*')
                ->from('dept_details')
                ->where(['dept_id'=> $id])
                ->all();
            $rowocr =(new \yii\db\Query())
                  ->select('*')
                 ->from('ocr_entry') 
                  ->where(['dep_id' => $id, 'finance_year'=>$yrpdf])
                  ->all(); 
    
    $masterstring .= "<div class='colmd-12'>
                        <table class='table table-striped '>
                            <tbody>
                                <tr>
                                    <td>Department
                                    </td>
                                    <td>".$rowdep[0]['dep_name'].
                                    "</td>
                                </tr>
                                <tr>
                                    <td>HOD
                                    </td>
                                    <td>".$rowdep[0]['dep_hod'].
                                    "</td>
                                </tr>
                                <tr>
                                    <td>Year
                                    </td>
                                    <td>".$yrpdf.
                                    "</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>";
            
            
      $masterstring .= "<div class='box_yr'id='". $yrpdf ."' >
                <div  style='background-color:#ddd; color:#000;text-align:center; font-size:11px;'>".           
                $yrpdf
                ."</div>";
      
      if($oc == 1){
     $masterstring .= "      <div  style='color:#421c52; background-color: #D9D6FF;  '>OCR Entry</div>
                 <table class='table table-striped table-bordered' style='text-align:right;  font-size:11px;' >
                    <thead>
                        <tr>
                            <th style='text-align:center; font-size:11px;'>Id</th>";
    if($oc0 ==1){ $masterstring .= "     <th style='text-align:center; font-size:11px;'>Amount</th>";}
    if($oc1 ==1){  $masterstring .= "     <th style='text-align:center; font-size:11px;'>Expenditure</th>";}
    if($oc2 ==1){  $masterstring .= "     <th style='text-align:center; font-size:11px;'>Balance</th>";}            
    $masterstring .= "                    </tr>
                    </thead>
                    <tbody>

                        <tr>

                            <td style='text-align:right;  font-size:11px;'>". $rowocr[0]['id']."</td>";
    if($oc0 ==1){  $masterstring .= "     <td style='text-align:right;  font-size:11px;'>". $rowocr[0]['opening_ammount']." </td>";}
    if($oc1 ==1){  $masterstring .= "     <td style='text-align:right;  font-size:11px;'>". $rowocr[0]['total_expend']." </td>";}
    if($oc2 ==1){  $masterstring .= "     <td style='text-align:right;  font-size:11px;'>". $rowocr[0]['avail_bal']." </td>";}   
    $masterstring .= "                </tr>

                    </tbody>
                </table>";
      }
           $rowbh =(new \yii\db\Query())
                   ->select('*')
                  ->from('budget') 
                   ->where(['dep_id' => $id, 'year'=> $yrpdf])
                   ->all();
        
    if($bh ==1 || $ex==1 || $ad==1){       
           foreach($rowbh as $yr=>$rowb){
    $masterstring .= "<div class='tbl' id='".$yrpdf.$rowb['budget_head']."'>
            <div  style='border-radius: 0px;text-align:center; font-size:11px; background-color: #e6c884; color:#421c52'>". 
            $rowb['budget_head'].
            "</div> ";
                  
            $rowbhs =(new \yii\db\Query())
                   ->select('*')
                   ->from('budget_head_status') 
                   ->where(['dep_id' => $id, 'year'=>$yrpdf,'bh_name'=>$rowb['budget_head']])
                   ->all();
     if( $bh == 1){     
    $masterstring .= "<div  style='color:#000; background-color: #D9D6FF;  '>Budget Head Status</div>
  <table class='table table-striped table-bordered' >
                <thead>
                    <tr>
                        <th style='text-align:center; font-size:11px;'>Id</th>";
  if($bh0 ==1){  $masterstring .= "    <th style='text-align:center; font-size:11px;'>Amount</th>";}
  if($bh1 ==1){  $masterstring .= "    <th style='text-align:center; font-size:11px;'>Expenditure</th>";}
  if($bh2 ==1){  $masterstring .= "    <th style='text-align:center; font-size:11px;'>Balance</th> ";}           
   $masterstring .= "            </tr>
                </thead>
                <tbody>

                    <tr>

                        <td style='text-align:right;  font-size:11px;'>". $rowbhs[0]['id']." </td>";
 if($bh0 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px;'>". $rowbhs[0]['bh_total_amount']."  </td>";}
 if($bh1 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px;'>". $rowbhs[0]['bh_expend']."  </td>";}
 if($bh2 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px;'>". $rowbhs[0]['bh_balance']."  </td>";}   
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
    $masterstring .= "<div style='color:#421c52; background-color: #D9D6FF/*#23527c*/;  '>Expenditure Report</div>
        <table class='table table-striped table-bordered' >
        <thead >
            <tr style='text-align:center; font-size:11px;'>
                <th style='text-align:center; font-size:11px;'>Entry no.</th>";
  if($ex0 ==1){  $masterstring .= " <th style='text-align:center; font-size:11px;'>Bill Date</th>";}
  if($ex1 ==1){  $masterstring .= " <th style='text-align:center; font-size:11px;'>Bill No.</th>";}
  if($ex2 ==1){  $masterstring .= " <th style='text-align:center; font-size:11px;'>Bill Diary No.</th>";}
  if($ex3 ==1){  $masterstring .= " <th style='text-align:center; font-size:11px;'>Amount</th>";}
  if($ex4 ==1){  $masterstring .= " <th style='text-align:center; font-size:11px;'>Payment Information</th>";}
  if($ex5 ==1){  $masterstring .= " <th style='text-align:center; font-size:11px;'>Description</th>";}
  if($ex6 ==1){  $masterstring .= " <th style='text-align:center; font-size:11px;'>satus</th>";}
  if($ex7 ==1){  $masterstring .= " <th style='text-align:center; font-size:11px;'>Remark</th>";}

 $masterstring .= "      </tr>
        </thead>
        <tbody style='text-align:right;  font-size:11px;'>";
            foreach($rowex as $no=>$rowe){ 
    $masterstring .= "   <tr>          
                <td style='text-align:right;  font-size:11px;'>". $rowe['id']." </td>";
  if($ex0 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px; '>". $rowe['bill_date']." </td>";}
  if($ex1 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px; '>". $rowe['bill_no']." </td>";}
  if($ex2 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px; '>". $rowe['bill_diary_no']." </td>";}
  if($ex3 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px; '>". $rowe['bill_amount']." </td>";}
  if($ex4 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px; '>". $rowe['payment_info']." </td>";}
  if($ex5 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px; '>". $rowe['desc']." </td>";}
  if($ex6 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px; '>";
                            if($rowe['status'] == 0) $masterstring .= "Pending";
                            if($rowe['status'] == 1) $masterstring .= "Approved";
                            if($rowe['status'] == 2) $masterstring .= "Rejected";
                            if($rowe['status'] == 3) $masterstring .= "Returned with objection";
                             $masterstring .=" </td>";}
  if($ex7 ==1){  $masterstring .= "   <td style='text-align:right;  font-size:11px; '>". $rowe['remark']." </td>";}
   $masterstring .= "    </tr>";
         } 
    $masterstring .= "</tbody>
        </table>
       </div>  "; }            
             
        
       $rowadv =(new \yii\db\Query())
                       ->select('*')
                      ->from('advance') 
                       ->where(['dep_id' => $id, 'year'=> $yrpdf, 'bh_name'=>$rowb['budget_head']])
                       ->all();
              
       if( $ad == 1){ 
        $masterstring .= "<div style='color:#421c52; background-color: #D9D6FF/*#23527c*/; ' >Advances</div>
        <table class='table table-striped table-bordered' >
        <thead>
            <tr>";
if($ad0 ==1){  $masterstring .= "                 <th style='text-align:center; font-size:11px;'>Entry no.</th>";}
if($ad1 ==1){  $masterstring .= "                <th style='text-align:center; font-size:11px;'>Budget Head</th>";}
if($ad2 ==1){  $masterstring .= "                <th style='text-align:center; font-size:11px;'>Amount</th>";}
if($ad3 ==1){  $masterstring .= "                <th style='text-align:center; font-size:11px;'>Drawn on</th>";}
if($ad4 ==1){  $masterstring .= "                <th style='text-align:center; font-size:11px;'>Settled on</th>";}
if($ad5 ==1){  $masterstring .= "                <th style='text-align:center; font-size:11px;'>Status</th>";}

 $masterstring .= "           </tr>
        </thead>
                <tbody>";
        foreach($rowadv as $no=>$rowad){ 
    $masterstring .= "   <tr>  ";        
if($ad0 ==1){  $masterstring .= "                <td style='text-align:right;  font-size:11px;'>". $rowad['exp_id']." </td>";}
if($ad1 ==1){  $masterstring .= "                <td style='text-align:right;  font-size:11px;'>". $rowad['bh_name']." </td>";}
if($ad2 ==1){  $masterstring .= "                <td style='text-align:right;  font-size:11px;'>". $rowad['amount']." </td>";}
if($ad3 ==1){  $masterstring .= "                <td style='text-align:right;  font-size:11px;'>". $rowad['drawn_on']." </td>";}
if($ad4 ==1){  $masterstring .= "                <td style='text-align:right;  font-size:11px;'>". $rowad['settled_on']." </td>";}
if($ad5 ==1){  $masterstring .= "                <td style='text-align:right;  font-size:11px;'>". $rowad['status_adv']." </td>";}
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
echo $masterstring;


?>
