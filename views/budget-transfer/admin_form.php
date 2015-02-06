<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BudgetTransfer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="budget-transfer-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col-md-12">
        <div class="row">
            
            <div  class="col-md-2 txthead" >Department ID<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php echo (int)$model->dep_id; ?>
                </span>
            </div>
            <div  class="col-md-2 txthead" >Department ID<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php echo (int)$model->year; ?>
                </span>
            </div>
        </div>
        <div class="row">
            
            <div  class="col-md-4 txthead" >From Budget Head<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php echo $model->from_bh; ?>
                </span>
            </div>
            <div class="col-md-4" style="text-align: center; font-size: 4em;">
                <i class="glyphicon glyphicon-share-alt"></i>
            </div>
            <div  class="col-md-4 txthead" >To Budget Head<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php echo $model->to_bh; ?>
                </span>
            </div>
        </div>
        <div class="row">
            
            <div  class="col-md-offset-4 col-md-4 txthead" >Amount<br> 
                <span class="rdbox" id="expenditure-dep_id" >
                    <?php echo (int)$model->amount; ?>
                </span>
            </div>
        </div>
    </div>

   
    <div class="row">
    <div class="col-md-offset-4 col-md-4 txthead"><?= $form->field($model, 'status')->
                            dropDownList(['pending' => 'Pending', 'approved'=>'Approved','Rejected' =>'Rejected']) ?></div>

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
