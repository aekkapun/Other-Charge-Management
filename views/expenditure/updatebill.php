
<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */

$this->title = 'Update Bill';
?>
 <div id="repeat">
      <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php $form = ActiveForm::begin(); ?>
   

     <div class="col-md-12" style="margin-top: 30px;">
      
        <div class="block">
        <div class="row">
            <div class="col-md-1"> <?php echo $form->field($model, 'bill_no')->textInput(['maxlength' => 50]) ?></div>

            <div class="col-md-2"> <?= $form->field($model, 'bill_date')->widget(DatePicker::className(),
                ['clientOptions' => ['dateFormat'=>'dd-mm-yyyy', 'format'=>'dd-mm-yyyy',
                     'changeYear'=>true, 'changeMonth'=>true,
                    'yearRange'=>'2010:2050']])->textInput(['readonly'=>TRUE, 'class'=>'date form-control'])  ?></div>

            <div class="col-md-2"> <?= $form->field($model, 'bill_diary')->textInput(['maxlength' => 50]) ?></div>

            <div class="col-md-2"> <?= $form->field($model, 'bill_amount')->textInput(['maxlength' => 20]) ?></div>
            
             <div class="col-md-2"> <?= $form->field($model,'vendor_details')->textarea(['rows' => 1]) ?></div>

            <div class="col-md-2"> <?= $form->field($model, 'remarks')->textInput(['maxlength' => 255]) ?></div>
            
           
        </div>
        
            </div>
      
        
 </div>

    
    <div class="form-group col-md-offset-6">
        <?= Html::submitButton('Submit',['class'=>'btn btn-success'])?>
    </div>
    
        <?php ActiveForm::end(); ?> 
  </div>

