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
            
            <div  class="col-md-2 txthead" style="display: none" >Department ID<br> 
                <span class="" id="expenditure-dep_id" >
                    <?php echo (int)$model->dep_id; ?>
                </span>
            </div>
    

    <div class="col-md-2"><?= $form->field($model, 'finance_year')?></div>
       
    <div class="col-md-3"><?php $dataCategory=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name');
    echo $form->field($model, "bh_name")->dropDownList($dataCategory, 
             ['prompt'=>'-Budget Head-',
                 'onchange'=>'showExpend();hello()'
              ])?></div>
    <div class="col-md-3"><?= $form->field($model, 'outstnd_adv')->textInput(['readonly'=>TRUE]) ?></div>
        </div>
        <div class="row">      
    <div class="col-md-3"><?= $form->field($model, 'bill_no')->textInput(['max'=>20]) ?></div>
    <div class="col-md-3"><?= $form->field($model, 'bill_date')
            ->widget(DatePicker::className(),
                ['clientOptions' => [
                    'dateFormat'=>'dd-mm-yyyy', 
                    'format'=>'dd-mm-yyyy',
                     'changeYear'=>true, 
                    'changeMonth'=>true,
                    'yearRange'=>'2010:2050'
                    ]
                    ])
            ->textInput(['readonly'=>TRUE, 'class'=>'date form-control']) ?>
    </div>
    <div class="col-md-3"><?= $form->field($model, 'bill_diary_no')->textInput(['max'=>20]) ?></div>
    <div class="col-md-3"><?= $form->field($model, 'bill_amount')->textInput(['max'=>20]) ?></div>
    
     
     
        </div>
       
        
        <div class="row">
       
    <div class="col-md-4"> <?= $form->field($model, 'payment_info')->textInput(['maxlength' => 100]) ?></div>
   
   

    <div class="col-md-8"><?= $form->field($model, 'desc')->textarea(['rows' => 1]) ?></div>

            </div>
        <div class="row">

    <div class="col-md-3 txthead">
        Status
        <br><span class="">
            <?php 
            if ($model->status == 0){?>
            <span style="color:#4422EE;">
            <?php echo 'Pending'; ?></span><?php } ?>
            
            <?php if ($model->status == 1) {?>
            <span style="color:#45B815;">
            <?php echo 'Approved'; ?></span><?php } ?>
            
            <?php if ($model->status == 2){?>
                <span style="color:#F00;">
            <?php echo 'Rejected'; ?></span><?php } ?>
            
            <?php if ($model->status == 3){?>
                <span style="color:#F00;">
            <?php echo 'Returned with Objection'; ?></span><?php } ?>
            
            
        </span>
    </div>

    <div class="col-md-9 txthead">
        Admin Remark
        <br><span class="">
            <?php echo $model->remark; ?>
        </span>
    </div>
        </div>

    </div>
    <div class="col-md-3" style="font-weight: bold; padding:0 15px 0 15px;text-align: left;" >
         <div class="row">
             <div class="col-md-6"><p> Total Amount:</p></div>
             <div class="col-md-6"style="text-align:right"><p>&#8377 <span style="color:#45B815;" id="amount"></span></p></div>
         </div>
         <div class="row">
             <div class="col-md-6"><p> Expenditure:</p></div>
             <div class="col-md-6"style="text-align:right"><p>&#8377 <span style="color:#4422EE;" id="expend"></span></p></div>
         </div>
         <div class="row">
             <div class="col-md-6"><p> Balance:</p></div>
             <div class="col-md-6"style="text-align:right"><p>&#8377 <span style="color:#F00;" id="balance"></span></p></div>
         </div>
         <div class="row">
             <div class="col-md-6"><p>Pending Advances:</p></div>
             <div class="col-md-6"style="text-align:right"><p> <span style="color:#F00;" id="a"></span></p></div>
         </div>
         
         
     </div>
    </div>

    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin: 15px 0 0 15px;']) ?>
    </div>

   

</div>
<?php
////The AJAX request for the Add Another button. It updates the #div-address-form div.
//$this->registerJs("
//   $(document).on('click', '#button-add-another', function(){
//       $.ajax({
//           url: '" . \Yii::$app->urlManager->createUrl(['awards/addmore']) . "',
//           type: 'post',
//           data: $('#settlement').serialize(),
//           success: function(data) {
//               $('#rep').html(data);
//           },
//           error: function() {
//               alert('An error has occured while adding a new block.');
//           }
//       });
//   });
//"); ?>