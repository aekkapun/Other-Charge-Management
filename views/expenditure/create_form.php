<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */
/* @var $form yii\widgets\ActiveForm */
$mon = date("m");
            if($mon < 04){
                $pyr = date("Y");
                $pyr = $pyr-1;
                $cyr = date("y");
                $year = $pyr.'-'.$cyr;
               
            }
            else{
                $pyr = date("Y");
                $cyr = date("y");
                $cyr = $cyr +1;
                $year = $pyr.'-'.$cyr;
               

            }
            $dep_id =Yii::$app->user->identity->id;
?>

<div class="expenditure-form">
    <?php  $rows=(new \yii\db\Query())
        ->select('*')
        ->from('budget_heads')        
       ->all();
    
 ?>

   
    <div class="col-md-12">
        <div class="col-md-12" 
             style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
             border: 1px solid #ccc; 
             background-color: #eee;
             border-radius:8px; 
             font-weight: bold; 
             padding:15px;
             text-align: left;" >
            <div class="col-md-2" id="dep" style="display: none"><?php echo $dep_id ;?></div>
                <div class="col-md-2" id="year" style="display: none"><?php echo $year;?></div>
                <div class="col-md-12">
                    <div class="col-md-2">Budget Head</div>
                    <div class="col-md-2">Total Amount</div>
                    <div class="col-md-2">Expenditure</div>
                    <div class="col-md-2">Balance</div>
                    <div class="col-md-2">Advances</div>
                </div>
                <div id="a"></div>
            
                  
        </div>
        <div class="col-md-12" style="margin-top: 40px;">
        <div class="row">
            
            <div  class="col-md-2 txthead" style="display: none">Department ID<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php //echo (int)$model->dep_id; ?>
                </span>
            </div>
    

    
       
   
    
<!--     <div class="col-md-2">
                <span style="color:#f00; margin-top: -5px;" class="amount"></span>-->
    <?php //echo $form->field($model, 'bill_amount')->textInput(['maxlength' => 20,  'onchange'=>'checkAmount()'])->label('Total Amount') ?>
            
<!--     </div>  -->

     
        </div>
       
   <?php $form = ActiveForm::begin(); ?>  
         <div id="repeat">
    
   

    <div class="col-md-12">
      <?php  foreach ($model as $i => $single): ?>
        
        <div class="block">
        <div class="row">
   
            <div class="col-md-2"><?php $dataCategory=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name');
    echo $form->field($single, "[$i]bh_name")->dropDownList($dataCategory, 
             ['prompt'=>'-Budget Head-',
                 
                 
                 
              ])?></div>
            
            <div class="col-md-1"> <?php echo $form->field($single, "[$i]bill_no")->textInput(['maxlength' => 50]) ?></div>

            <div class="col-md-2"> <?= $form->field($single, "[$i]bill_date")->widget(DatePicker::className(),
                ['clientOptions' => ['dateFormat'=>'dd-mm-yyyy', 'format'=>'dd-mm-yyyy',
                     'changeYear'=>true, 'changeMonth'=>true,
                    'yearRange'=>'2010:2050']])->textInput(['readonly'=>TRUE,
                        'class'=>'date form-control']) ?></div>

            <div class="col-md-2"> <?= $form->field($single, "[$i]bill_diary_no")->textInput(['maxlength' => 50])->label('Diary No') ?></div>

            <div class="col-md-2"> <?= $form->field($single, "[$i]bill_amount")->textInput(['maxlength' => 20,  'onchange'=>'checkAmount()']) ?></div>

            
            
            <div class="col-md-2"> <?= $form->field($single,"[$i]desc")->textarea(['rows' => 1]) ?></div>

          
            
            <div class="col-md-1">
               <a href="#"><span class="glyphicon glyphicon-plus-sign" id="but" style="margin-top:30px; color: green; font-size: 1.5em;"></span></a>
<!--                <a href="#"><span class="glyphicon glyphicon-minus-sign" id="rem" style="margin-top:30px; color: red; font-size: 1.5em;"></span></a>
              -->
               <!-- <div class="form-group"><button id="but" class="btn btn-primary">Add</button></div>-->
            </div>
        </div>
       
            </div>
        <?php    endforeach; ?>
        <span style="display: none" id="i"><?php echo $i;?></span>
 </div>

  </div>
    </div>
    
    </div>

    
    
    <div class="form-group col-md-offset-6">
        <?= Html::submitButton( 'Submit',['class' => 'btn btn-primary ', 'style' => 'margin: 15px 0 0 15px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
//The AJAX request for the Add Another button. It updates the #div-address-form div.
$this->registerJs("
     
    $(document).on('click', '#but', function(){
   
        $.ajax({
             url: '" . \Yii::$app->urlManager->createUrl(['expenditure/addmoreex']) . "',
            type     :'POST',
            cache    : false,
            data: $('#" . $form->id . "').serialize(),
            success: function(data) {
            document.getElementById('repeat').innerHTML = data;

               
            },
            error: function() {
               alert('An error has occured while adding a new block.');
            }
        });
     
    });

$(document).on('click', '#rem', function(){
 var count = document.getElementById('ide').innerHTML;
     if(count == 0){    
     document.getElementById('ide').innerHTML = 0;
     alert('One Row should be present in Table');
     
     }
     else{
     $(this).closest('.block').remove();
     count--;
     document.getElementById('ide').innerHTML = count;
     }
});
");
?>
<script type="text/javascript">
 
    var dep =   document.getElementById("dep").innerHTML; 
    var year = document.getElementById('year').innerHTML;
   
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
             
                document.getElementById("a").innerHTML = xmlhttp.responseText;
            }
        }
       
        xmlhttp.open("GET", "query1?yr=" + year + "&dep=" + dep, true);
        xmlhttp.send();
        
</script>
      