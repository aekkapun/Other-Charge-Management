
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */



?>

    <?php $form = ActiveForm::begin(); ?>
   

 <div class="row">
      <?php  foreach ($model as $i => $single): ?>

    <div class="col-md-2"> <?= $form->field($single, "[$i]bill_no")->textInput(['maxlength' => 50]) ?></div>
    
    <div class="col-md-2"> <?= $form->field($single, "[$i]bill_date")->textInput(['maxlength' => 15]) ?></div>
    
    <div class="col-md-3"> <?= $form->field($single, "[$i]bill_diary")->textInput(['maxlength' => 50]) ?></div>
    
    <div class="col-md-3"> <?= $form->field($single, "[$i]bill_amount")->textInput(['maxlength' => 20]) ?></div>
    
    <div class="col-md-2">
        <?= Html::button('Press me!', ['class' => 'teaser','id'=>'but']) ?>
       <!-- <div class="form-group"><button id="but" class="btn btn-primary">Add</button></div>-->
    </div>


    <div class="col-md-4"> <?= $form->field($single,"[$i]vendor_details")->textarea(['rows' => 1]) ?></div>
    
    <div class="col-md-6"> <?= $form->field($single, "[$i]remarks")->textInput(['maxlength' => 255]) ?></div>

        <?php    endforeach; ?>
 </div>
    
    <div class="form-group">
        <?= Html::submitButton('Submit',['class'=>'btn btn-success'])?>
    </div>
    
        <?php ActiveForm::end(); ?> 

<?php
//The AJAX request for the Add Another button. It updates the #div-address-form div.
$this->registerJs("
    $('button.but').click(function(){
   
        $.ajax({
            url: '" . \Yii::$app->urlManager->createUrl(['expenditure/addmore']) . "',
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
