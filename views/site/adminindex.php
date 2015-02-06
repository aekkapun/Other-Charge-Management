<?php
/* @var $this yii\web\View */
$this->title = 'OCM';
//$year = date("Y");
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

?>
<div class="container">
<div class="site-index">
    <script>
         var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var object = JSON.parse(xmlhttp.responseText);
        document.getElementById("noti").innerHTML = object.expense;
        document.getElementById("noti-bud").innerHTML = object.budget;
        document.getElementById("noti-ad").innerHTML = object.advance;
        
                
                var nota = object.advance;            
                if( nota == "sorry" ){
                  $(".not-box-ad").hide();
                }                
                var notb = object.budget;              
                if( notb == "sorry" ){
                  $(".not-box-bud").hide();
                }
                var note = object.expense;            
                if( note == "sorry" ){
                  $(".not-box").hide();
                }
            }
        }
        xmlhttp.open("GET", "notification", true);
        xmlhttp.send();
        function globalsearch(){
                             var x=$('#gsearch').val();
                             if(x=='')
                             {x='qwe@';}
                           // var x=document.getElementById("gsearch");
                             var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                var object = JSON.parse(xmlhttp.responseText);
                                if(object.exp != ''){
                                var out = "<table class='table table-striped table-bordered'>\n\
                                        <thead><tr><th>OCR no.</th>\n\
                                        <th>Year</th> \n\
                                        <th>Budget Head</th> \n\
                                        <th>Amount</th>\n\
                                        <th>Bill No.</th>\n\
                                        <th>Bill Diary No.</th>\n\
                                        <th>Type</th>\n\
                                        <th>Status</th>\n\
                                        <th>Advance Status</th>\n\
                                        <th>Description</th>\n\
                                        <th>Drawn On</th>\n\
                                        <th>Settled On</th></tr> </thead>";
                                        
                                    for(i = 0; i < object.exp.length; i++) {
                                        out += "<tr><td>" +
                                        object.exp[i].id +
                                        "</td><td>" +
                                        object.exp[i].finance_year +
                                        "</td><td>" +
                                         object.exp[i].bh_name +
                                        "</td><td>" +
                                         object.exp[i].bill_amount +
                                        "</td><td>" +
                                         object.exp[i].bill_no +
                                        "</td><td>" +
                                         object.exp[i].bill_diary_no +
                                        "</td><td>" +
                                        object.exp[i].outstnd_adv +
                                        "</td><td>";
                                if(object.exp[i].status== 0){
                                    out+="Pending";
                                }
                                if(object.exp[i].status== 1){
                                    out+="Approved";
                                }
                                if(object.exp[i].status== 2){
                                    out+="Rejected";
                                }
                                if(object.exp[i].status== 3){
                                    out+="Returned With Objection";
                                }
                                
                                         out+=
                                        "</td><td>" ;
                                if(object.exp[i].outstnd_adv== 'Advance'){
                                if(object.exp[i].advance_status== 0){
                                    out+="Unsettled";
                                }
                                if(object.exp[i].advance_status== 1){
                                    out+="Settled";
                                }
                            }
                            else{
                                out+="-";
                            }
                            
                                         out+=
                                                 "</td><td>" +
                                         object.exp[i].desc +
                                        "</td><td>" +
                                         object.exp[i].drawn_on +
                                        "</td><td>" +
                                        object.exp[i].settled_on +
                                        "</td></tr>";
                                $('#myModal').modal();
                                
                             
                                    }out += "</table>";
                                  
                                    
                                    }
                                    else{ var out = '';
                                    }
                                    if(object.set != ''){
                                    out += "<table class='table table-striped table-bordered'>";
                                     out += "   <thead><tr><th>OCR no.</th>\n\
                                 <th>Bill Amount</th>\n\
                                        <th>Bill No.</th>\n\
                                        <th>Bill Diary No.</th>\n\
                                        <th>Remarks</th>\n\
                                        <th>Vendor Details</th>\n\
                                        </tr> </thead>";
                                        
                                    for(i = 0; i < object.set.length; i++) {
                                        out += "<tr><td>" +
                                        object.set[i].ocr_no+
                                        "</td><td>" +
                                        object.set[i].bill_amount +
                                        "</td><td>" +
                                         object.set[i].bill_no +
                                        "</td><td>" +
                                         object.set[i].bill_diary +
                                        "</td><td>" +
                                         object.set[i].remarks +
                                        "</td><td>" +
                                         object.set[i].vendor_details +
                                        "</td>";
                              
                                
                                         
                                $('#myModal').modal();
                                
                             
                                    }
                                    }
                                    else{ out += '';
                                    }
                                    out += "</table>"
                                    
                                document.getElementById("search-result").innerHTML = out;
                                
                                
                            }
                        }
                        xmlhttp.open("GET", 'gsearch?x=' + x, true);
                        xmlhttp.send();
                        }
        </script>

    

    <div class="body-content">
        <div class="row" style="width: 1242px;">
        <div class="col-sm-2 col-md-offset-9" style="margin-top: 20px; ">
            <div class="form-group">
                <input  class="form-control" id="gsearch" onchange="globalsearch()" placeholder="Search">
            </div>
        </div>
</div>
        <div class="col-md-12" style="margin-top: 10px; margin-bottom: 20px;">
            
            <div class="col-lg-3 box" >
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/financial-year/index'?>">
                    <div class="blocks" style="background-color: #6a123d/*#460023/*#9CDEC9*/">
                        <?php
               
               $rown =(new \yii\db\Query())
                ->select('*')
                ->from('financial_year_tbl') 
                ->where(['year'=>$year])
                ->all();   
                 $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){}
                            $i++;}
                ?>
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-4" style="font-size: 5em; text-align: left;margin-left:-25px;"><i class="glyphicon glyphicon-calendar"></i></div>
                        <div class="" >
                            <div style="text-align: right; margin: 0 -10px 0 0;">Financial Year - <?php echo $year; ?></div>
                            <div style="font-size: 3.5em;"><?php echo $i; ?></div>
                            <p style="margin:0 -35px 0 -35px;">No. of Departments
                            </p>
                        </div>
                        </div>
                        
                    </div>  
                </a>
            </div>
            <div class="col-lg-3 box">
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget/index'?>">
                    <div class="blocks" style="background-color: #14a46d/*#B2CCE6*/">
                        <?php
               
               $rown =(new \yii\db\Query())
                        ->select('*')
                ->from('budget') 
                ->where(['year'=>$year])
                ->all(); 
               $am=0;
                foreach ($rown as $i=>$row){
                    $am += $row['bh_netfund'];
                }
                $i++;?>
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-4" style="font-size: 5em; text-align: left;">
                            <i class="glyphicon glyphicon-briefcase"></i></div>
                        <div class="col-md-8" >
                            <div style="text-align: right;">Year - <?php echo $year; ?></div>
                            <div style="font-size: 2em;">&#8377 &nbsp;<?php echo $am; ?></div>
                        <p>Net Budget</p>
                        </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 box">
                 <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget-heads/index'?>">
                    <div class="blocks" style="background-color: #EB6122;/* #f0ad4e;/*#fa0*/">
                        <?php
               
               $rown =(new \yii\db\Query())
                        ->select('*')
                        ->from('budget_heads') 
                        ->all(); 
                       $am=0;
                       $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){}
                            $i++;}
                ?>
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-4" style="font-size: 5em; text-align: left;margin-left:-25px;">
                            <i class="glyphicon glyphicon-list-alt"></i></div>
                        <div class="" >
                            <div style="text-align: right; margin: 0 -10px 0 0;">Year - <?php echo $year; ?></div>
                            <div style="font-size: 3.5em;"><?php echo $i; ?></div>
                            <p style="margin:0 -35px 0 -35px;">Budget Heads
                            </p>
                        </div>
                        </div>
                     
                    </div>
                </a>
            </div>
            <div class="col-lg-3 box">
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/advance'?>">
                    <div class="blocks" style="background-color:#25046c;/*#0636c5*/"> 
                         <?php
               
               $rown =(new \yii\db\Query())
                      ->select('*')
                            ->from('expenditure_tbl') 
                            ->where([ 'outstnd_adv'=>'Advance', 'advance_status'=>'0'])
                            ->all();
                            $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){}
                            $i++;}?>
                        <div class="col-md-12" style="padding-bottom: -10px;">
                            <div class="col-md-4" style="font-size: 5em; text-align: left;">
                                <i class="glyphicon glyphicon-flag"></i></div>
                                <div class="col-md-8 "  style="padding-right:0px; margin-right: -10px;">

                                 <div style="text-align: right;">Year - <?php echo $year; ?></div>
                                 <div style="font-size: 3.5em; padding-bottom: 0px;"><?php echo $i; ?></div>


                            </div>
                        </div>
                        <p>Unsettled Advances</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 box ">
                <div class="not-box" title="Pending Request, Click here to check"> 
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/pendingrequest'?>">
                <p class="col-md-offset-10" style="position:absolute;background-color:#0daffd; color: #fff;height:25px; width:25px; border-radius: 50%; padding:4px;">
                    <span id="noti">  </span>
                        </p>
                 </a>
                </div>
                
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/index'?>">
                    <div class="blocks"  style="background-color: #0b4e00">
                         <?php
               
               $rown =(new \yii\db\Query())
                      ->select('*')
                            ->from('expenditure_tbl') 
                            ->where([ 'outstnd_adv'=>'advance'])
                            ->all();
                            $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){
                                                            }
                            $i++;}?>
                
              
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-4" style="font-size: 5em; text-align: left;">
                            <i class="glyphicon glyphicon-stats"></i></div>
                            <div class="col-md-8 "  style="padding-right:0px; margin-right: -10px;">
                           
                                <div style="text-align: right;">Year - <?php echo $year; ?></div>
                                <div style="font-size: 3.5em; padding-bottom: 0px;"><?php //echo $i; ?></div>
                            
                            
                        </div>
                        </div>
                        <p>Expenditures</p>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 box">
                <div class="not-box-ad" title="Advance Requests, Click here to check"> 
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/advance-request'?>">
                <p class="col-md-offset-10" style="position:absolute;background-color:#0daffd; color: #fff;height:25px; width:25px; border-radius: 50%; padding:4px;">
                    <span id="noti-ad">  </span>
                        </p>
                 </a>
                </div>
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/all-advance'?>">
                    <div class="blocks" style="background-color: #840026">
                        <?php
               
               $rown =(new \yii\db\Query())
                      ->select('*')
                            ->from('expenditure_tbl') 
                            ->where([ 'outstnd_adv'=>'advance'])
                            ->all();
                             $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){
                                                            }
                            $i++;}?>
                
              
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-4" style="font-size: 5em; text-align: left;">
                            <i class="glyphicon glyphicon-unchecked"></i></div>
                            <div class="col-md-8 "  style="padding-right:0px; margin-right: -10px;">
                           
                                <div style="text-align: right;">Year - <?php echo $year; ?></div>
                                <div style="font-size: 3.5em; padding-bottom: 0px;"><?php //echo $i; ?></div>
                            
                            
                        </div>
                        </div>
                        <p>Advances</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 box" >
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/log/index'?>">
                    <div class="blocks" style="background-color: #1594d2">
                        <?php
               
               $rown =(new \yii\db\Query())
                      ->select('*')
                            ->from('expenditure_tbl') 
                            ->where([ 'outstnd_adv'=>'advance'])
                            ->all();
               $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){
                                                            }
                            $i++;}?>
                
              
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-4" style="font-size: 5em; text-align: left;">
                            <i class="glyphicon glyphicon-lock"></i></div>
                            <div class="col-md-8 "  style="padding-right:0px; margin-right: -10px;">
                           
                                <div style="text-align: right;">Year - <?php echo $year; ?></div>
                                <div style="font-size: 3.5em; padding-bottom: 0px;"><?php //echo $i; ?></div>
                            
                            
                        </div>
                        </div>
                      <p>Logs</p>
                    </div>  
                </a>
            </div>
            <div class="col-lg-3 box">
                <div class="not-box-bud" title="Pending Request, Click here to check"> 
                <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget-transfer/budgetrequests'?>">
                <p class="col-md-offset-10" style="position:absolute;background-color:#0daffd; color: #fff;height:25px; width:25px; border-radius: 50%; padding:4px;">
                    <span id="noti-bud">  </span>
                        </p>
                 </a>
                </div>
                 <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget-transfer/index'?>">
                    <div class="blocks" style="background-color: #EB6122;/* #f0ad4e;/*#fa0*/">
                        <?php
               
               $rown =(new \yii\db\Query())
                        ->select('*')
                        ->from('budget_transfer') 
                       ->where(['status' => "approved"])
                        ->all();
                        $i=0;
                            if($rown)    {    
                            foreach ($rown as $i=>$row){}
                            $i++;}?>
                        <div class="col-md-12" style="padding-bottom: -10px;">
                        <div class="col-md-4" style="font-size: 5em; text-align: left;">
                            <i class="glyphicon glyphicon-share"></i></div>
                             <div class="col-md-8" >
                            <div style="text-align: right;">Year - <?php echo $year; ?></div>
                            <div style="font-size: 3.5em;"><?php echo $i; ?></div>
                            <p>Budget Transfer</p>
                        </div>
                        </div>
                       
                    </div>
                </a>
            </div>
            
         </div>

    </div>
</div>
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
