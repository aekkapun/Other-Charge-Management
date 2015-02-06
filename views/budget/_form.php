<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\DeptDetails;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Budget */
/* @var $form yii\widgets\ActiveForm */
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

<div class="budget-form">
<?php if(Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
    <div class="alert alert-danger">
        Please fill the correct division of the total budget, Refresh to go back.
    </div>
  <?php  elseif(Yii::$app->session->hasFlash('wrongBudget')): ?>
    <div class="alert alert-danger">
        Budget already allocated for this department, Refresh to go back.
    </div>
    <?php else: ?>
    <?php $form = ActiveForm::begin(); $label = ""; ?>
    
<?php  $rows=(new \yii\db\Query())
        ->select('*')
        ->from('budget_heads')        
       ->all();
 ?>
   
<?php foreach($model as  $value): ?>
<?php foreach($rows as $key => $row): ?>
   
    <div class="col-md-12 "  <?php if($key > 0 ){?> style="display:none;" <?php } ?> > 
  
    
        <div class="col-md-3">
            <?php $dataCategory=ArrayHelper::map(DeptDetails::find()->asArray()->all(), 'dept_id', 'dep_name');
            echo $form->field($value, "[$key]dep_id")
                    ->dropDownList($dataCategory,[
                         'prompt'=>'-Select Department-', 
                         'onchange'=>'showUser()'
                      ])
                         ?>
        </div>
        
        <div class="col-md-2">
                <?= $form->field($value, "[$key]year")->textInput(['value'=>$year, 'readonly'=>TRUE]) ?>
               
        </div>

        <div class="col-md-2"><?= $form->field($value, "[$key]date_order")
               ->widget(DatePicker::className(),[
                   'clientOptions' => [
                       'dateFormat'=>'dd-mm-yyyy',
                       'format'=>'dd-mm-yyyy',
                       'changeYear'=>true, 
                       'changeMonth'=>true,
                       'yearRange'=>'2010:2050'
                       ]
                   ])
               ->textInput(['readonly'=>TRUE, 'class'=>'date form-control'])?>
        </div>

        <div class="col-md-2"><?= $form->field($value, "[$key]file_ref_no")->textInput(['maxlength' => 50]) ?> </div>
        <div class="col-md-3 " style="font-weight: bold; padding:0 15px 0 15px;text-align: right;">Amount Alloted:<p id="txtHint" style="color:#f00;"> </p></div>
    </div>
    
    
    <div class="col-md-12" style="padding-top: 15px;">
            <div class="col-md-3" style="font-weight: bold; padding:0 15px 0 15px; text-transform: capitalize">
                <span <?php if($key > 0 ){?> style="display:none;" <?php } ?>>Budget Head:</span>
                <p style="color:#005801" > <?php echo $row['bh_name']?> </p><?php //$form->field($value, "[$key]budget_head")->textInput(['maxlength' => 30]) ?> 
            </div>

            <div class="col-md-2">       
                <?= $form->field($value, "[$key]bh_fund")->textInput(['maxlength' => 15, 'id'=>'one'.$key, 'value'=>'0']) ?>
                <span class="added3" style="color:#f00;"></span>
            </div>

            <div class="col-md-2">
                        <?= $form->field($value, "[$key]deduction")->textInput(['id'=>'two'.$key ])->label('Deduction (%)') ?>
            </div>
        
             <div class="col-md-2"><?= $form->field($value, "[$key]bh_netfund")->textInput(['maxlength' => 15,'id'=>'three'.$key, 'readonly'=>TRUE ]) ?> </div>

            <div class="col-md-2"><?= $form->field($value, "[$key]bh_desc")->textarea(['rows' => 1]) ?> </div>

    </div>

    
<?php endforeach; ?>
    <?php endforeach; ?>
    <div class="col-md-12" style="font-weight: bold; padding:0 15px 0 15px; text-transform: capitalize">
        <div class="col-md-3">total</div>
         <div class="col-md-2" > &#8377 <span id="added" style="color:#f00;"></span></div>
          <div class="col-md-2"></div>
           <div class="col-md-2"  > &#8377 <span id="added1" style="color:#f00;"></span></div>
    </div>
     
    <p id="key" style="display:none"><?php echo $key; ?></p>
   
 <div class="form-group">
    
        <?= Html::submitButton( 'Submit',['class' => 'btn btn-success', 'style' => 'margin:15px 0 0 25px'] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php endif;?>
