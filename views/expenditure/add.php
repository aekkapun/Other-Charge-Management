
<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */


?>
 <div id="repeat">
    <?php $form = ActiveForm::begin(['action'=>\Yii::$app->urlManager->createUrl(['expenditure/set', 'id'=>$modelex->id])]); ?>
   

    <div class="col-md-12">
      <?php  foreach ($model as $i => $single): ?>
        <div class="block">
        <div class="row">
            <div class="col-md-1"> <?php echo $form->field($single, "[$i]bill_no")->textInput(['maxlength' => 50]) ?></div>

            <div class="col-md-2"> <?= $form->field($single, "[$i]bill_date")->widget(DatePicker::className(),
                ['clientOptions' => ['dateFormat'=>'dd-mm-yyyy', 'format'=>'dd-mm-yyyy',
                     'changeYear'=>true, 'changeMonth'=>true,
                    'yearRange'=>'2010:2050']])->textInput(['readonly'=>TRUE, 'class'=>'date form-control'])  ?></div>

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
        <div style="display: none"  value=""><span id="ide"><?php echo $i;?></span></div>
 </div>

    
    <div class="form-group">
        <?= Html::submitButton('Submit',['class'=>'btn btn-success'])?>
    </div>
    
        <?php ActiveForm::end(); ?> 
  </div>
<?php
//The AJAX request for the Add Another button. It updates the #div-address-form div.
$this->registerJs("
    $('a.but').click(function(){
   
        $.ajax({
            url: '" . \Yii::$app->urlManager->createUrl(['expenditure/addmore','id'=>$modelex->id]) . "',
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
    $(document).on('click', '#rem', function(){
$(this).remove();
    
});
"); ?>
