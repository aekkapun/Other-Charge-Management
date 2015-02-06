<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenditure-form">
    <?php  $rows=(new \yii\db\Query())
        ->select('*')
        ->from('budget_heads')        
       ->all();
 ?>

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
    <div class="col-md-9">
        <div class="row">
            
            <span style="display:none;" id="expenditure-dep_id" > <?php echo $model->dep_id; ?></span>
            <div  class="col-md-3 txthead"><span >Department Name</span><br> 
                <span class="rdbox"  >
                    <?php 
                    $rowo=(new \yii\db\Query())
                    ->select('*')
                    ->from('dept_details') 
                    ->where(['dept_id'=>$model->dep_id])
                    ->all();?>
                    <?php echo $rowo[0]['dep_name'];?>
                   
                </span>
            </div>
            
            <div  class="col-md-3 txthead" >Financial Year<br> 
                <span class="rdbox" id="expenditure-finance_year" >
                    <?php echo $model->finance_year; ?>
                </span>
            </div>
            
            <div  class="col-md-3 txthead" >Budget Head<br> 
                <span class="rdbox" id="expenditure-bh_name" >
                    <?php echo $model->bh_name; ?>
                </span>
            </div>
             <div  class="col-md-3 txthead" >Type<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php echo $model->outstnd_adv; ?>
                </span>
            </div>
        </div>
        
        <div  class="col-md-3 txthead" >Bill Amount<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php echo $model->bill_amount; ?>
                </span>
            </div>
        
        <div class="row" style="margin-top: 10px;">
            
           
            
            <div  class="col-md-6 txthead" >Payment Information<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php echo $model->payment_info; ?>
                </span>
            </div>
            
           
            
            <div  class="col-md-6 txthead" >Description<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php echo $model->desc; ?>
                </span>
            </div>
        </div>
        
        
        <div class="row"  style="margin-top: 10px;">

            <div class="col-md-3"><?= $form->field($model, 'status')->dropDownList(['0' => 'Pending', '1'=>'Approved','2' =>'Rejected','3'=>'Returned with Objection']) ?></div>

    <div class="col-md-9"><?= $form->field($model, 'remark')->textarea(['rows' => 1]) ?></div>
        </div>

    </div>
    <div class="col-md-3" style="font-weight: bold; padding:0 15px 0 15px;text-align: left;" >
         <div class="row">
             <div class="col-md-6"><p> Total Amount:</p></div>
             <div class="col-md-6" style="text-align:right"><p>&#8377 <span style="color:#45B815;" id="amount"></span></p></div>
         </div>
         <div class="row">
             <div class="col-md-6"><p> Expenditure:</p></div>
             <div class="col-md-6" style="text-align:right"><p>&#8377 <span style="color:#4422EE;" id="expend"></span></p></div>
         </div>
         <div class="row">
             <div class="col-md-6"><p> Balance:</p></div>
             <div class="col-md-6" style="text-align:right"><p>&#8377 <span style="color:#F00;" id="balance"></span></p></div>
         </div>
         <div class="row">
             <div class="col-md-6"><p>Pending Advances:</p></div>
             <div class="col-md-6" style="text-align:right"><p> <span style="color:#F00;" id="a"></span></p></div>
         </div>
         
         
     </div>
</div>

    

    <div class="form-group col-md-offset-6">
        <?= Html::submitButton($model->isNewRecord ? 'Update' : 'Submit', ['class' => $model->isNewRecord ? 'btn btn-success  col-md-offset-5' : 'btn btn-primary col-md-offset-5', 'style' => 'margin: 15px 0 0 15px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
