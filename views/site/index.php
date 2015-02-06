<?php
/* @var $this yii\web\View */
$this->title = 'OCM';
$mon = date("m");
if($mon < 04){
    $pyr = date("Y");
    $pyr = $pyr-1;
    $cyr = date("y");
    $year = $pyr.'-'.$cyr;
    //echo $year;
}
else{
    $pyr = date("Y");
    $cyr = date("y");
    $cyr = $cyr +1;
    $year = $pyr.'-'.$cyr;
    //echo $year;
    
}
               $id = Yii::$app->user->identity->id;
?>
 
 <div class="container">
<div class="site-index">
<script type="text/javascript">
                       var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                document.getElementById("noti-user").innerHTML = xmlhttp.responseText;
                                var not = xmlhttp.responseText;   
                               // alert( xmlhttp.responseText);
                                if( not === "sorry" ){
                                  $(".not-box-user").hide();
                                }
                            }
                        }
                        xmlhttp.open("GET", 'notuser', true);
                        xmlhttp.send();
                        
//                        function globalsearch(){
//                             var x=$('#gsearch').val();
//                             if(x=='')
//                             {x='qwe@';}
//                           // var x=document.getElementById("gsearch");
//                             var xmlhttp = new XMLHttpRequest();
//                        xmlhttp.onreadystatechange = function() {
//                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//                                var object = JSON.parse(xmlhttp.responseText);
//                                var out = "<table class='table table-striped table-bordered'>\n\
//                                        <thead><tr><th>OCR no.</th>\n\
//                                        <th>Year</th> \n\
//                                        <th>Budget Head</th> \n\
//                                        <th>Amount</th>\n\
//                                        <th>Bill No.</th>\n\
//                                        <th>Bill Diary No.</th>\n\
//                                        <th>Type</th>\n\
//                                        <th>Status</th>\n\
//                                        <th>Advance Status</th>\n\
//                                        <th>Drawn On</th>\n\
//                                        <th>Settled On</th></tr> </thead>";
//                                        
//                                    for(i = 0; i < object.length; i++) {
//                                        out += "<tr><td>" +
//                                        object[i].id +
//                                        "</td><td>" +
//                                        object[i].finance_year +
//                                        "</td><td>" +
//                                         object[i].bh_name +
//                                        "</td><td>" +
//                                         object[i].bill_amount +
//                                        "</td><td>" +
//                                         object[i].bill_no +
//                                        "</td><td>" +
//                                         object[i].bill_diary_no +
//                                        "</td><td>" +
//                                 object[i].outstnd_adv +
//                                        "</td><td>";
//                                if(object[i].status== 0){
//                                    out+="Pending";
//                                }
//                                if(object[i].status== 1){
//                                    out+="Approved";
//                                }
//                                if(object[i].status== 2){
//                                    out+="Rejected";
//                                }
//                                if(object[i].status== 3){
//                                    out+="Returned With Objection";
//                                }
//                                
//                                         out+=
//                                        "</td><td>" ;
//                                if(object[i].outstnd_adv== 'Advance'){
//                                if(object[i].advance_status== 0){
//                                    out+="Unsettled";
//                                }
//                                if(object[i].advance_status== 1){
//                                    out+="Settled";
//                                }
//                            }
//                            else{
//                                out+="-";
//                            }
//                                         out+=
//                                        "</td><td>" +
//                                         object[i].drawn_on +
//                                        "</td><td>" +
//                                        object[i].settled_on +
//                                        "</td></tr>";
//                                    }
//                                    out += "</table>"
//                                document.getElementById("search-result").innerHTML = out;
//                                
//                                $('#myModal').modal();
//                                var not = xmlhttp.responseText;   
//                             
//                                
//                            }
//                        }
//                        xmlhttp.open("GET", 'gsearch?x=' + x, true);
//                        xmlhttp.send();
//                        }
</script>  

        <div class="row">
           
            <div class="col-md-3 col-sm-3 box " >
                <?php
               
               $rown =(new \yii\db\Query())
                ->select('*')
                ->from('financial_year_tbl') 
                ->where(['year'=>$year, 'dep_id'=> $id,])
                ->all(); 
              
                $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){}
                            $i++;}?>
              <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/financial-year/userindex'?>">
                    <div class="blocks" style="z-index: 1; background-color: #AA3939/*#9CDEC9*/">
                        
                        <div class="col-md-12" style="padding-bottom: -10px;">
                       <div class="col-md-4 col-xs-4" style="font-size: 4em; text-align: left;margin-left:-25px;"><i class="glyphicon glyphicon-calendar"></i></div>
                       <div style="text-align: right;margin:0 -15px 0 15px; padding: 0 0 0 12px;">Financial Year - <?php echo $year; ?></div>
                        </div>
                        <div class="col-md-12" style=" text-align: center; margin-top:-20px;">
                            <p>Total Amount</p>
                            <p style="font-size: 2em;" >
                            <?php if(empty($rown)){?>
                               &#8377 <?php echo '0.0';
                                
                            }
                            else{
                                echo '&#8377 &nbsp;'.$rown[0]['total_fund'];
                            }?></p>
                            
                        </div>
                        
                    </div>  
                </a>
            </div>
            <div class="col-md-3 col-sm-3 box">
            <?php $rown =(new \yii\db\Query())
                ->select('*')
                ->from('ocr_entry') 
                ->where(['finance_year'=>$year, 'dep_id'=> $id,])
                ->all();
       // var_dump($rown);die;?>
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget/userindex'?>">
                   <div class="blocks" style="background-color: #AA5939">
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-5" style="font-size: 3.5em; text-align: left; margin:0 0 -10px -10px;">
                            <i class="glyphicon glyphicon-briefcase"></i></div>
                        <div class="col-md-7" style="text-align: right;">Year - <?php echo $year; ?></div>
                        </div>
                        <div class="col-md-12" style=" text-align: center;">
                            <p>Budget</p>
                            <p style="font-size: 2em;">
                               <?php
                               if(!empty($rown)){?>
                                &#8377 <?php echo $rown[0]['opening_ammount']; ?>
                               <?php }
                               else{ ?>
                                 &#8377 <?php echo '0.0'; 
                               }
?>
                            </p>
                        </div>
                        
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 box">
                 <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/ocr-entry/userindex'?>">
                    <div class="blocks" style="background-color:#323776">
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-5" style="font-size: 3.5em; text-align: left; margin:0 0 -10px -10px;">
                            <i class="glyphicon glyphicon-align-justify"></i></div>
                        <div class="col-md-7" style="text-align: right;">Year - <?php echo $year; ?></div>
                        </div>
                        <div class="col-md-12" style=" text-align: center;">
                            <p>Total Expenditure</p>
                            <p style="font-size: 2em;">
                               <?php
                               if(empty($rown)){ ?>
                                 &#8377 <?php  echo"0.0";
                               }
                               else{
                               if($rown[0]['total_expend'] == 0 ){?>
                                &#8377 <?php echo "0.0"; ?>
                               <?php }
                               else{ ?>
                                 &#8377 <?php  echo$rown[0]['total_expend'];
                               }}?>

                            </p>
                        </div>
                        
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 box">
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget-head-status/userindex'?>">
                    <div class="blocks" style="background-color:#2D8632"> 
                        <?php $rown =(new \yii\db\Query())
                            ->select('*')
                            ->from('budget_head_status') 
                            ->where(['year'=>$year, 'dep_id'=> $id,])
                            ->all();
                   // var_dump($rown);die;?>
               
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-5" style="font-size: 3.5em; text-align: left; margin:0 0 -10px -10px;">
                            <i class="glyphicon glyphicon-th"></i></div>
                        <div class="col-md-7" style="text-align: right;">Year - <?php echo $year; ?></div>
                        </div>
                        <div class="col-md-12" style=" text-align: center;">
                            <p>
                               
                                <?php echo ''; ?><br>
                               
                                
                            </p>
                        </div>
                        
                         <p>Budget Head Statuses</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 box ">
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/returned'?>">
                <div class="not-box-user" title="Returned with Objection"> 
                <p class="col-md-offset-10" style="position:absolute;background-color:#FEFE00; color: #000;height:25px; 
                                                    width:25px; border-radius: 50%; border: 1px solid #000; padding:4px;">
                    <span id="noti-user">  </span>
                </p>
                </div>
                </a>
                
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/userindex'?>">
                    <div class="blocks"  style="background-color: #540002">
                        
                        <?php $rown =(new \yii\db\Query())
                            ->select('*')
                            ->from('expenditure_tbl') 
                            ->where(['finance_year'=>$year, 'dep_id'=> $id, 'status'=>1, 'outstnd_adv'=>'Expenditure'])
                            ->all();
                            $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){}
                            $i++;}?>
               
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-5" style="font-size: 4em; text-align: left; margin:0 0 -10px -10px;">
                            <i class="glyphicon glyphicon-stats"></i></div>
                        <div class="col-md-7" style="text-align: right;">Year - <?php echo $year; ?></div>
                        </div>
                        
                        
                        <div class="col-md-12" style=" text-align: center;">
                            <div  class="col-md-2 col-md-offset-5"style="padding: 6px 6px 6px 6px; background-color: #fff; color:#540002; border-radius: 50%;">
                                <b><?php echo $i; ?></b></div>
                            <div > <i class="glyphicon glyphicon-share-alt"></i>&nbsp;Approved</div>
                        </div>
                 
                        
                        <p>Expenditures</p>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-sm-3 box">
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/all-advance-user'?>">
                    <div class="blocks" style="background-color: #003333">
                        
                        <?php $rown =(new \yii\db\Query())
                            ->select('*')
                            ->from('expenditure_tbl') 
                            ->where(['finance_year'=>$year, 'dep_id'=> $id, 'outstnd_adv'=>'Advance'])
                            ->all();
                    //var_dump($rown);
                    $i=0;
                if($rown)    {    
                foreach ($rown as $i=>$row){
                                                }
                $i++;}?>
               
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-5" style="font-size: 4em; text-align: left; margin:0 0 -10px -10px;">
                            <i class="glyphicon glyphicon-unchecked"></i></div>
                        <div class="col-md-7" style="text-align: right;">Year - <?php echo $year; ?></div>
                        </div>
                        <div class="col-md-12" style=" text-align: center;">
                            <div class="col-md-offset-5 col-xs-offset-5 "
                                 style="background-color: #fff; color:#003333; border-radius: 50%; text-align: center; height: 35px; width: 35px; ">
                                <div style="padding: 8px 6px 6px 6px;"><b><?php echo $i; ?></b></div>
                            </div>
                        </div>
                        
                        <p>Advances Status<p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 box">
               
               <?php
               
               $rown =(new \yii\db\Query())
                ->select('*')
                ->from('expenditure_tbl') 
                ->where(['finance_year'=>$year, 'dep_id'=> $id, 'outstnd_adv'=>'Expenditure', 'status'=>0])
                ->all();
                $i=0;
                if($rown)    {    
                foreach ($rown as $i=>$row){
                                                }
                $i++;}?>
 
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/pendingexpends'?>">
                    <div class="blocks" style="background-color: #AA5939">
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-5" style="font-size: 4em; text-align: left; margin:0 0 -10px -10px;">
                            <i class="glyphicon glyphicon-tasks"></i></div>
                        <div class="col-md-7" style="text-align: right;">Year - <?php echo $year; ?></div>
                        </div>
                        <div class="col-md-12" style=" text-align: center;">
                            <div class="col-md-offset-5 col-xs-offset-5 "
                                 style="background-color: #fff; color:#AA5939; border-radius: 50%; text-align: center; height: 35px; width: 35px; ">
                                <div style="padding: 8px 6px 6px 6px;"><b><?php echo $i; ?></b></div>
                            </div>
                        </div>
                        <p>Pending Expenditures</p>
                       
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 box">
                 <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/useradvance'?>">
                    <div class="blocks" style="background-color: #323776">
                        <?php $rown =(new \yii\db\Query())
                            ->select('*')
                            ->from('expenditure_tbl') 
                            ->where(['finance_year'=>$year, 'dep_id'=> $id,  'outstnd_adv'=>'advance', 'advance_status'=> 0])
                            ->all();
                                $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){
                                                            }
                            $i++;}?>
               
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-5" style="font-size: 4em; text-align: left; margin:0 0 -10px -10px;">
                            <i class="glyphicon glyphicon-credit-card"></i></div>
                        <div class="col-md-7" style="text-align: right;">Year - <?php echo $year; ?></div>
                        </div>
                        <div class="col-md-12" >
                            <div class="col-md-offset-5 col-xs-offset-5 "
                                 style="background-color: #fff; color:#323776; border-radius: 50%; text-align: center; height: 35px; width: 35px; ">
                                <div style="padding: 8px 6px 6px 6px;"><b><?php echo $i; ?></b></div>
                            </div>
                        </div>
                        <p>Unsettled Advances</p>
                    </div>
                </a>
            </div>
            
            </div>
            
            <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Search Result</h4>
      </div>
      <div class="modal-body">
       <div  id="search-result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
        </div>
    </div>
  </div>
            
             
            
            
      
    </div>
 </div>

