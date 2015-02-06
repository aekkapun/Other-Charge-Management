<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;
use app\models\YearsTbl;

/* @var $this yii\web\View */
/* @var $model app\models\BudgetTransfer */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    function getBHAmount(){
         var dep =  parseInt($('#budgettransfer-dep_id').val()); 
         var year = $('#budgettransfer-year').val();
         var bh = $('#budgettransfer-from_bh').val();
         
     var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("amount").innerHTML = xmlhttp.responseText;
                            
                
            }
        }
        xmlhttp.open("GET", "query?dep=" + dep + "&yr=" + year + "&bh=" + bh, true);
        xmlhttp.send();
    }
    function compare(){
        var   bal=  parseInt(document.getElementById("amount").innerHTML);
        var am = parseInt($('#budgettransfer-amount').val()); 
       
        if (bal<am){
            document.getElementById("error").innerHTML = "Amount exceeds";
        }
    }
    </script>
<div class="budget-transfer-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">

       <div class="row"> 
<div class="col-md-2" style="display:none"><?= $form->field($model, 'dep_id')->textInput(['maxlength' => 25]) ?></div>
           
            <div class="col-md-2"><?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); 
                   echo $form->field($model, "year")->dropDownList($dataCategory1, 
             ['prompt'=>'-Year-',
                 'onchange'=>'getBHAmount()'
              ])?>
            </div>
           
            <div class="col-md-2" style="color:#f00; font-weight: bold; ">
                Balance- &#8377; &nbsp;<span id="amount" ></span> 
            </div>
       </div>
        
       <div class="row">
           
            <div class="col-md-4">
                <?php $dataCategory=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name');
                echo $form->field($model, 'from_bh')->dropDownList($dataCategory, 
                         ['prompt'=>'-Select BudgetHead-',
                             'onchange' => 'getBHAmount()'])
                        ?>
                <span id="error" style="color:#f00;">
                </span>
            </div>
    
    
        <div class="col-md-4" style="text-align: center; font-size: 4em;">
                    <i class="glyphicon glyphicon-share-alt"></i>
        </div>

        <div class="col-md-4">
         <?php $dataCategory=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name');
         echo $form->field($model, 'to_bh')->dropDownList($dataCategory, 
                  ['prompt'=>'-Select BudgetHead-'])
                 ?>
         </div>
    
      </div>

    <div class="row">
        <div class="col-md-offset-4 col-md-4"><?= $form->field($model, 'amount')->textInput(['maxlength' => 25, 'onchange' => 'compare()']) ?></div>
    </div>
        
   
</div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin: 15px 0 0 15px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
