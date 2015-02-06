
<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */

$this->title = 'Settlement:'.' '.'OCR No.'.$modelex->id.'';

?>
<div class="expenditure-update space back">
 <h3 class="headings"><?= Html::encode($this->title) ?></h3>
 <div class="col-md-12"  style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
             border: 1px solid #ccc; 
             background-color: #eee;
             border-radius:8px; 
             font-weight: bold; 
             padding:15px;
             text-align: left;">
     <div class="row"><span id="idd" style="display:none"><?= $modelex->id ?></span>
         
         <div class="col-md-3 txthead">Year:&nbsp;<span class="rdbox"><?= $modelex->finance_year ?></span>
         </div>
     <div class="col-md-3 txthead">Budget Head:&nbsp;
        <span class="rdbox"><?= $modelex->bh_name ?></span></div>
         <div class="col-md-3 txthead">Amount:&nbsp;
        <span class="rdbox">&#8377;&nbsp;<?= $modelex->bill_amount ?></span></div>
     </div>
     <div class="row">
     <div class="col-md-3 txthead">Remark:&nbsp;
        <span class="rdbox"><?= $modelex->payment_info ?></span></div>
     <div class="col-md-3 txthead">Description:&nbsp;
        <span class="rdbox"><?= $modelex->desc ?></span></div>
     </div>
     
 </div>
 <div id="repeat" style="margin-top: 60px; padding-top: 60px">
    <?php $form = ActiveForm::begin(['action'=>\Yii::$app->urlManager->createUrl(['expenditure/set'])]); ?>
   

    <div class="col-md-12">
      <?php  foreach ($model as $i => $single): ?>
        <div class="block">
        <div class="row">
            <div class="col-md-1"> <?php echo $form->field($single, "[$i]bill_no")->textInput(['maxlength' => 50]) ?></div>

            <div class="col-md-2"> <?= $form->field($single, "[$i]bill_date")->widget(DatePicker::className(),
                ['clientOptions' => ['dateFormat'=>'dd-mm-yyyy', 'format'=>'dd-mm-yyyy',
                     'changeYear'=>true, 'changeMonth'=>true,
                    'yearRange'=>'2010:2050']])->textInput(['readonly'=>TRUE,
                        'class'=>'date form-control'])  ?></div>

            <div class="col-md-2"> <?= $form->field($single, "[$i]bill_diary")->textInput(['maxlength' => 50]) ?></div>

            <div class="col-md-2"> <?= $form->field($single, "[$i]bill_amount")->textInput(['maxlength' => 20]) ?></div>
            
            <div class="col-md-2"> <?= $form->field($single,"[$i]vendor_details")->textarea(['rows' => 1]) ?></div>

            <div class="col-md-2"> <?= $form->field($single, "[$i]remarks")->textInput(['maxlength' => 255]) ?></div>
            
            <div class="col-md-1">
               <a href="#"><span class="glyphicon glyphicon-plus-sign" id="but" style="margin-top:30px; color: green; font-size: 1.5em;"></span></a>
                <a href="#"><span class="glyphicon glyphicon-minus-sign" id="rem" style="margin-top:30px; color: red; font-size: 1.5em;"></span></a>
              
              
            </div>
        </div>
        
            </div>
        <?php    endforeach; ?>
        
        
 </div>

    
    <div class="form-group">
        <?= Html::submitButton('Submit',['class'=>'btn btn-success'])?>
    </div>
    
        <?php ActiveForm::end(); ?> 
  </div>

</div>
<?php
//The AJAX request for the Add Another button. It updates the #div-address-form div.
$this->registerJs("
    $(document).on('click', '#but', function(){
   
        $.ajax({
             url: '" . \Yii::$app->urlManager->createUrl(['expenditure/addmore','id'=>$modelex->id]) . "',
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
