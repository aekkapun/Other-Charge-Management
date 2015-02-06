 <script type="text/javascript">
         function getbh(){
        
        var year = document.getElementById("sel1").value;
        var id = document.getElementById("dep").innerHTML;
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("sel2").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "querybh?yr=" + year +"&id=" +id, true);
        xmlhttp.send();
        $(".box_yr").show();
        $(".tbl").show();
        $(".box_yr").hide();
         $("#"+year).show();
       
        
    }
    function pdf(){
        var year = document.getElementById("sel1").value;
        var id = document.getElementById("dep").innerHTML;
        
        if(year){window.open("pdf?id="+ id +"&yr=" + year);
         }
        else{
            alert("Year is not selected");
        }
    }
    function showrep(){
        var bh = document.getElementById("sel2").value;
        var yr = document.getElementById("sel1").value;
        if(bh == "all"){
                 $(".box_yr").show();
                 $(".tbl").show();
                 $(".box_yr").hide();
                 $("#"+yr).show();  
        }
        else{
                 
                $(".tbl").hide();        
                $("#"+yr+bh).show();       
        }
    }

</script>
<?php
$this->title = 'Reports';
if(Yii::$app->user->can("admin")){
    
}
else{
$id = Yii::$app->user->identity->id;
}
$rown =(new \yii\db\Query())
                ->select('*')
                ->from('dept_details')
                ->where(['dept_id'=> $id])
                ->all();?>
<div class="col-md-12" >
    <div class="col-md-12" style="border-radius: 5px;padding: 10px 0 0 0; font-weight: bold;margin-top:20px; text-align: center; background-color: #639; color:#fff;text-transform: capitalize">
        
    <div class="col-md-6" style="font-size: 1.5em;">
        department-<?php if($rown) {echo $rown[0]['dep_name'];}?>
    </div>
    <div class="col-md-6" style="font-size: 1.5em;">
        HOD-<?php if($rown) { echo $rown[0]['dep_hod'];}?>
    </div><br>
    <br>
        <div class="col-md-2  " style="margin-top:15px;">
<form role="form">
    <div class="form-group">
    
      <select class="form-control" id="sel1" onchange="getbh();">
          <option value="" id="">Select Year</option>
          <?php 
            $rown =(new \yii\db\Query())
                ->select('*')
                ->from('financial_year_tbl')
                ->where(['dep_id'=> $id])
                ->all();   
                foreach ($rown as $i=>$row){?>
                 
                     <option value="<?php echo $row['year']?>" id="yr<?php echo $row['year']?>">
                     <?php echo $row['year'] ?>
                     
                     </option>
               <?php }  ?>
           
      </select>
      
    </div>
  </form>
</div>
<div class="col-md-3" style="margin-top:15px;">
<form role="form">
    <div class="form-group">
      
      <select class="form-control" id="sel2" onchange="showrep()">   
          <option value="" id="">Select Budget Head</option>
      </select>      
    </div>
  </form>
</div>
    </div>
    </div>
   

<div id="dep" style="display:none"><?php echo $id;?></div>
<br><br>
<div class="col-md-12 grand" style="margin-top:40px;">
<?php 
     $rowyr =(new \yii\db\Query())
            ->select('*')
           ->from('financial_year_tbl') 
            ->where(['dep_id' => $id])
            ->all();
     foreach($rowyr as $yr=>$rowy){?>
     <?php $rowocr =(new \yii\db\Query())
            ->select('*')
           ->from('ocr_entry') 
            ->where(['dep_id' => $id, 'finance_year'=>$rowy['year']])
            ->all(); ?>
    
    <div class="box_yr"id="<?php echo $rowy['year'] ?>" >
        <div class="headings" style="font-weight: bold; font-size: 1.3em;">            
                <?php echo $rowy['year'] ?>
        </div>
       
        <p style="font-weight:bold; color: #333">
            Total Amount <span style="color:red">&#8377 <?php echo $rowocr[0]['opening_ammount'];?> </span>
            &nbsp; (Total Expenditure <span style="color:red">&#8377 <?php echo $rowocr[0]['total_expend'];?> </span>       
            and Available Balance <span style="color:red">&#8377 <?php echo $rowocr[0]['avail_bal'];?></span>)
        </p>
       
     
   <?php         $rowbh =(new \yii\db\Query())
                   ->select('*')
                  ->from('budget') 
                   ->where(['dep_id' => $id, 'year'=> $rowy['year']])
                   ->all();?>
  
   
    <?php        foreach($rowbh as $yr=>$rowb){?>
        <div class="tbl" id="<?php echo $rowy['year'].$rowb['budget_head']; ?>">
            <div class="headings" style=" border-radius: 0px;font-size:1.3em ; background-color: #e6c884; color:#421c52"> 
                <?php echo$rowb['budget_head']; ?></div> 
               <?php   $rowbhs =(new \yii\db\Query())
                   ->select('*')
                  ->from('budget_head_status') 
                   ->where(['dep_id' => $id, 'year'=> $rowy['year'],'bh_name'=>$rowb['budget_head']])
                   ->all();?>
            <div  style="color:#421c52; background-color: #D9D6FF; padding:5px;">Budget Head Status</div>
                <table class="table table-striped table-bordered" >
    <thead>
        <tr>
            
            <th>Amount</th>
            <th>Expenditure</th>
            <th>Balance</th>            
        </tr>
    </thead>
    <tbody>
        
        <tr>
          
           
            <td><?php echo $rowbhs[0]['bh_total_amount'];?> </td>
            <td><?php echo $rowbhs[0]['bh_expend'];?> </td>
            <td><?php echo $rowbhs[0]['bh_balance'];?> </td>   
         </tr>
       
    </tbody>
</table>
                 
                 
                 
                 
                 
                 
                 
               <?php 
                    $rowex =(new \yii\db\Query())
                       ->select('*')
                      ->from('expenditure_tbl') 
                       ->where(['dep_id' => $id, 'finance_year'=> $rowy['year'], 'bh_name'=>$rowb['budget_head']])
                       ->all();
                    ?>
            <div style="color:#421c52; background-color: #D9D6FF/*#23527c*/; padding:5px;">Expenditure Report</div>
        <table class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th>OCR no.</th>
            <th>Bill No.</th>
            <th>Amount</th>
    <th>Type</th>
   <th>Status</th>
   <th>Advance Status</th>
            <th>Payment Information</th>
            <th>Description</th>
            
        </tr>
    </thead>
    <tbody>
        <?php  foreach($rowex as $no=>$rowe){ ?>
        <tr>
          
            <td><?php echo $rowe['id'];?> </td>
            <td><?php echo $rowe['bill_no'];?> </td>
            <td><?php echo $rowe['bill_amount'];?> </td>
            <td><?php echo $rowe['outstnd_adv'];?> </td>
            <td><?php 
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
            }?> 
            </td>
            <td><?php 
            if($rowe['outstnd_adv']=='Expenditure'){
                echo '';
            }
            else{
                if($rowe['advance_status'] == 0){
                   echo 'Unsettled'; 
                }
                if($rowe['advance_status'] == 1){
                   echo 'Settled'; 
                }
            }?>
            </td>
            <td><?php echo $rowe['payment_info'];?> </td>
            <td><?php echo $rowe['desc'];?> </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
        </div>               
            <?php } ?>
            
    </div><br>
   <?php  } ?>
    <input type="hidden" id="yrp" name="yrp"></div>

  
    <a onclick="pdf()" target="_blank"><button class="btn btn-success">Print</button></a>
</div>



              