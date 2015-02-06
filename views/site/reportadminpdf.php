
<?php
$this->title = 'Reports';


$rown =(new \yii\db\Query())
                ->select('*')
                ->from('dept_details')
                ->where(['dept_id'=> $id])
                ->all();?>
<div style="text-transform: capitalize; font-weight: bold;  margin-left: 30px;" >
    <table class="table table-striped " style="text-transform: capitalize; background-color: #f1f0ff;">
        <tbody>
            <tr>
                 <td style="font-size:12px;">
                     Department
                </td>
                 <td style="font-size:12px;">
                    <?php echo $rown[0]['dep_name']?>
                </td>
            </tr>
            <tr>
                 <td style="font-size:12px;">
                     HOD
                </td>
                 <td style="font-size:12px;">
                    <?php echo $rown[0]['dep_hod']?>
                </td>
            </tr>
            <tr>
                 <td style="font-size:12px;">
                     year
                </td>
                 <td style="font-size:12px;">
                    <?php echo $yrpdf;?>
                </td>
            </tr>
        </tbody>
    </table>
    
</div>
   
   

<div id="dep" style="display:none"><?php echo $id;?></div>

<div class="col-md-12 grand" style="margin-top:40px;">

     
     <?php $rowocr =(new \yii\db\Query())
            ->select('*')
           ->from('ocr_entry') 
            ->where(['dep_id' => $id, 'finance_year'=>$yrpdf])
            ->all(); ?>
    
    <div class="box_yr"id="<?php echo $yrpdf ?>" >
        <div style="background-color:#ccc;text-align: center">            
                <?php echo $yrpdf ?>
        </div>
       <p style="font-weight:bold; color: #333">
            Total Amount <span style="color:red"> &#8377; <?php 
            if(empty($rowocr)){echo '';}
                            else{
                            echo   $rowocr[0]['opening_ammount']; }
            ?> </span>
            &nbsp; (Total Expenditure <span style="color:red">&#8377; <?php if(empty($rowocr)){echo '';}
                            else{
                            echo   $rowocr[0]['total_expend']; }?> </span>       
            and Available Balance <span style="color:red">&#8377; <?php if(empty($rowocr)){echo '';}
                            else{
                            echo   $rowocr[0]['avail_bal']; }?></span>)
        </p>
       
     
   <?php         $rowbh =(new \yii\db\Query())
                   ->select('*')
                  ->from('budget') 
                   ->where(['dep_id' => $id, 'year'=> $yrpdf])
                   ->all();
   
   ?>
  
   
    <?php        foreach($rowbh as $yr=>$rowb){?>
        <div class="tbl" id="<?php echo $yrpdf.$rowb['budget_head']; ?>">
            <div  style=" text-align: center; background-color: #e6c884; color:#000"> <?php echo$rowb['budget_head']; ?></div> 
               <?php   $rowbhs =(new \yii\db\Query())
                   ->select('*')
                  ->from('budget_head_status') 
                   ->where(['dep_id' => $id, 'year'=>$yrpdf,'bh_name'=>$rowb['budget_head']])
                   ->all();
           ?>
            <div  style="color:#000; background-color: #D9D6FF; ">Budget Head Status</div>
                <table class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th style="text-align:center;  font-size:11px;">Amount</th>
            <th style="text-align:center;  font-size:11px;">Expenditure</th>
            <th style="text-align:center;  font-size:11px;">Balance</th>            
        </tr>
    </thead>
    <tbody>
        
        <tr>
             <td style="text-align:right;  font-size:11px;"><?php echo $rowbhs[0]['bh_total_amount'];?> </td>
             <td style="text-align:right;  font-size:11px;"><?php echo $rowbhs[0]['bh_expend'];?> </td>
             <td style="text-align:right;  font-size:11px;"><?php echo $rowbhs[0]['bh_balance'];?> </td>   
         </tr>
       
    </tbody>
</table>
                 
                 
                 
                 
                 
                 
                 
               <?php 
                    $rowex =(new \yii\db\Query())
                       ->select('*')
                      ->from('expenditure_tbl') 
                       ->where(['dep_id' => $id, 'finance_year'=> $yrpdf, 'bh_name'=>$rowb['budget_head']])
                       ->all();
                    ?>
            <div style="color:#421c52; background-color: #D9D6FF/*#23527c*/; ">Expenditure Report</div>
        <table class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th style="text-align:center;  font-size:11px;">OCR no.</th>
            <th style="text-align:center;  font-size:11px;">Bill No.</th>
            <th style="text-align:center;  font-size:11px;">Amount</th>
            <th style="text-align:center;  font-size:11px;">Type</th>
            <th style="text-align:center;  font-size:11px;">Status</th>
            <th style="text-align:center;  font-size:11px;">Advance Status</th>
            <th style="text-align:center;  font-size:11px;">Payment Information</th>
            <th style="text-align:center;  font-size:11px;">Description</th>
            
        </tr>
    </thead>
    <tbody>
        <?php  foreach($rowex as $no=>$rowe){ ?>
        <tr>
          
             <td style="text-align:right;  font-size:11px;"><?php echo $rowe['id'];?> </td>
             <td style="text-align:right;  font-size:11px;"><?php echo $rowe['bill_no'];?> </td>             
             <td style="text-align:right;  font-size:11px;"><?php echo $rowe['bill_amount'];?> </td>
             <td style="text-align:right;  font-size:11px;"><?php echo $rowe['outstnd_adv'];?> </td>
             <td style="text-align:right;  font-size:11px;">
                 <?php 
            if($rowe['status']=='0'){
                echo 'Pending';                
            }
            if($rowe['status']=='1'){
                echo 'Approved';                
            }
            if($rowe['status']=='2'){
                echo 'Rejected';                
            }
            if($rowe['status']=='3'){
                echo 'Retuned with Objection';                
            }?>  </td>
             <td style="text-align:right;  font-size:11px;"><?php if($rowe['outstnd_adv']=='Expenditure'){
                echo '';
            }
            else{
                if($rowe['advance_status'] == 0){
                   echo 'Unsettled'; 
                }
                if($rowe['advance_status'] == 1){
                   echo 'Settled'; 
                }
            }?> </td>             
             <td style="text-align:right;  font-size:11px;"><?php echo $rowe['payment_info'];?> </td>
             <td style="text-align:right;  font-size:11px;"><?php echo $rowe['desc'];?> </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
        </div>               
            <?php } ?>
            
    </div><br>
   
    
</div>



              