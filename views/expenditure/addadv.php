<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

use yii\jui\DatePicker;
?>
 <?php $form = ActiveForm::begin(); ?>
 <?php  foreach ($model as $i => $single): ?>
        <div class="col-md-12 block" style="margin-top: 30px;">      
                            
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
               <a href="#"><span class="glyphicon glyphicon-minus-sign" id="rem" style="margin-top:30px; color: red; font-size: 1.5em;"></span></a>

            </div>

   
        
    </div>
        <?php    endforeach; ?>
  <div style="display: none"  value=""><span id="ide"><?php echo $i;?></span></div>
    <?php ActiveForm::end(); ?>
<?php
//The AJAX request for the Add Another button. It updates the #div-address-form div.
$this->registerJs("
    $('a.but').click(function(){
   
        $.ajax({
            url: '" . \Yii::$app->urlManager->createUrl(['expenditure/addmoreadv']) . "',
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