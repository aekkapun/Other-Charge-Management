<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Draw Advance';
$this->params['breadcrumbs'][] = ['label' => 'Expenditures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php 

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
<div class="col-md-2" id="year" style="display: none"><?php echo $year;?></div>
<div class="col-md-2" id="dep" style="display: none"><?php echo $dep_id ;?></div>
<div class="expenditure-view">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

<div class="col-md-12" 
             style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
             border: 1px solid #ccc; 
             background-color: #eee;
             border-radius:8px; 
             font-weight: bold; 
             padding:15px;
             text-align: left;" >
            
                
                <div class="col-md-12">
                    <div class="col-md-2">Budget Head</div>
                    <div class="col-md-2">Total Amount</div>
                    <div class="col-md-2">Expenditure</div>
                    <div class="col-md-2">Balance</div>
                    <div class="col-md-2">Advances</div>
                </div>
                <div id="a"></div>
            
                  
</div>

    <div class="draw-advance" style="margin-top: 30px;">
    <?php  $rows=(new \yii\db\Query())
        ->select('*')
        ->from('budget_heads')        
        ->all();
    ?>

    <?php $form = ActiveForm::begin(); ?>
        <?php  foreach ($model as $i => $single): ?>
        <div class="col-md-12" id="repeat" style="margin-top: 30px;">      
                            
            <div class="col-md-2">
                <?php $dataCategory=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name');
                echo $form->field($single, "[$i]bh_name")->dropDownList($dataCategory, 
                ['prompt'=>'-Budget Head-',
                // 'onchange'=>'showExpend(this.value);hello(this.value)'
                ])?>
            </div>
            <div class="col-md-2">
                <span style="color:#f00; margin-top: -5px;" class="amount"></span>
                <?= $form->field($single, "[$i]bill_amount")
                        ->textInput([
                        'maxlength' => 20, 
                        //'onchange'=>'checkAmount()'
                        ])
                        ->label('Amount') 
                ?>
            
            </div>
            <div class="col-md-3"> 
                            <?= $form->field($single, "[$i]payment_info")->textInput(['maxlength' => 100]) ?>
            </div>
            <div class="col-md-3">
                            <?= $form->field($single, "[$i]desc")->textarea(['rows' => 1]) ?>
            </div>
            <div class="col-md-1">
               <a href="#"><span class="glyphicon glyphicon-plus-sign" id="but" style="margin-top:30px; color: green; font-size: 1.5em;"></span></a>
            </div>

   
        
    </div>
        <?php    endforeach; ?>
<!--    <div class="col-md-3" style="font-weight: bold; padding:0 15px 0 15px;text-align: left;" >
         <div class="row">
             <div class="col-md-6"><p> Total Amount:</p></div>
             <div class="col-md-6"><p>&#8377 <span style="color:#45B815;" id="amount"></span></p></div>
         </div>
         <div class="row">
             <div class="col-md-6"><p> Expenditure:</p></div>
             <div class="col-md-6"><p>&#8377 <span style="color:#4422EE;" id="expend"></span></p></div>
         </div>
         <div class="row">
             <div class="col-md-6"><p> Balance:</p></div>
             <div class="col-md-6"><p>&#8377 <span style="color:#F00;" id="balance"></span></p></div>
         </div>
         <div class="row">
             <div class="col-md-6"><p>Pending Advances:</p></div>
             <div class="col-md-6"><p> <span style="color:#F00;" id="a"></span></p></div>
         </div>
         
         
     </div>-->
    </div>

    
    
    <div class="form-group col-md-offset-5">
 <?= Html::submitButton( 'Draw',['class' => 'btn btn-primary ', 'style' => 'margin: 15px 0 0 15px;']) ?>    </div>

    <?php ActiveForm::end(); ?>
    <br><br><br><br><br>
</div>
<?php
//The AJAX request for the Add Another button. It updates the #div-address-form div.
$this->registerJs("
     
    $(document).on('click', '#but', function(){
   
        $.ajax({
             url: '" . \Yii::$app->urlManager->createUrl(['expenditure/addmoreadv']) . "',
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
      