<script type="text/javascript">

		$.datepicker.initialized = true;
                               </script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\BudgetHeads;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */

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
?>
 <div id="repeat">
     <div class="col-md-2" id="year" style="display: none"><?php echo $year;?></div>
    <?php $form = ActiveForm::begin(); ?>
   

    <div class="col-md-12">
      <?php   $dep_id =Yii::$app->user->identity->id;
      foreach ($model as $i => $single): ?>
                 <div class="col-md-2" id="dep" style="display: none"><?php echo $dep_id ;?></div>
        <div class="block">
        <div class="row">
            <div class="col-md-2"><?php $dataCategory=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name');
    echo $form->field($single, "[$i]bh_name")->dropDownList($dataCategory, 
             ['prompt'=>'-Budget Head-',
              ])?></div>
           
            <div class="col-md-1"> <?php echo $form->field($single, "[$i]bill_no")->textInput(['maxlength' => 50]) ?></div>

            <div class="col-md-2">
               
 <?= $form->field($single, "[$i]bill_date")
                    ->widget(DatePicker::className(),[
                        'clientOptions' => [
                            'dateFormat'=>'dd-mm-yyyy', 
                            'format'=>'dd-mm-yyyy',
                            'changeYear'=>true,
                            'changeMonth'=>true,
                            'yearRange'=>'2010:2050'
                            ]
                        ])
                    ->textInput(['readonly'=>TRUE,
                        'class'=>'date form-control'
                        ])?>
            </div>
            

            <div class="col-md-2"> <?= $form->field($single, "[$i]bill_diary_no")->textInput(['maxlength' => 50])->label('Diary No') ?></div>

            <div class="col-md-2"> <?= $form->field($single, "[$i]bill_amount")->textInput(['maxlength' => 20,  'onchange'=>'checkAmount()']) ?></div>

            
            
            <div class="col-md-2"> <?= $form->field($single,"[$i]desc")->textarea(['rows' => 1]) ?></div>

          
            
            <div class="col-md-1">
               <a href="#"><span class="glyphicon glyphicon-plus-sign" id="but" style="margin-top:30px; color: green; font-size: 1.5em;"></span></a>
                <a href="#"><span class="glyphicon glyphicon-minus-sign" id="rem" style="margin-top:30px; color: red; font-size: 1.5em;"></span></a>
             
               <!-- <div class="form-group"><button id="but" class="btn btn-primary">Add</button></div>-->
            </div>
        </div>
       
            </div>
        <?php    endforeach; ?>
                 <div style="display: none"  value=""><span id="ide"><?php echo $i;?></span></div>
 </div>

    
    
    
        <?php ActiveForm::end(); ?> 
  </div>
<?php
//The AJAX request for the Add Another button. It updates the #div-address-form div.
$this->registerJs("
    $('a.but').click(function(){
   
        $.ajax({
            url: '" . \Yii::$app->urlManager->createUrl(['expenditure/addmoreex']) . "',
            type: 'post',
            data: $('#" . $form->id . "').serialize(),
            success: function(data) {
                $('#repeat').html(data);
            },
            error: function() {
                alert('An error has occured while adding a new block.');
            }
        });
    });

"); ?>
