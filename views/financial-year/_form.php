<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\DeptDetails;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\FinancialYear */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="financial-year-form">
<?php if(Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
    <div class="alert alert-danger">
        Fund already allocated to this department, Refresh to go back.
    </div>
    <?php else: ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
            <?php $dataCategory=ArrayHelper::map(DeptDetails::find()->asArray()->all(), 'dept_id', 'dep_name');
    echo $form->field($model, 'dep_id')->dropDownList($dataCategory, 
             ['prompt'=>'-Select Department-', 
                 'onchange'=>'showHod()'
                 
              ])
            ?></div>
    
            <div class="col-md-4"><?= $form->field($model, 'dep_hod')->textInput(['maxlength' => 50, 'readonly' => TRUE]) ?></div>

            <div class="col-md-4">
            <?php $dataCategory1=ArrayHelper::map(\app\models\YearsTbl::find()->asArray()->all(), 'year', 'year');
    echo $form->field($model, 'year')->dropDownList($dataCategory1, 
             ['prompt'=>'-Select Year-'])
            ?>
           </div>
            
        </div>
        <div class="row">
            <div class="col-md-3"><?= $form->field($model, 'total_fund')->textInput(['maxlength' => 50]) ?></div>
        </div>
        <div class="row">
            <div class="col-md-5"><?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?></div>
        </div>   
    </div>
  
   
   

  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php endif;?>