<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Departments;
use dosamigos\tinymce\TinyMce;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\DeptDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dept-details-form">
    <div calss="col-md-12">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row">
        <div class="col-md-4"><?=  $form->field($model, 'dep_name')->textInput(['readonly' => true])->label("Department Name") ?></div>

        <div class="col-md-2"><?= $form->field($model, 'dep_year')->textInput(['maxlength' => 10])->label("Year of Establishment") ?></div>
        <div class="col-md-2"><?= $form->field($model, 'dep_website')->textInput(['maxlength' => 50])->label("Department Website") ?></div>
        </div>
          <div class="row">                   
              <div class="col-md-4"><?= $form->field($model, 'dep_email')->textInput(['readonly' => true])->label("Department Email ID") ?></div>
              <div class="col-md-4"><?= $form->field($model, 'dep_hod')->textInput(['maxlength' => 50])->label("Head of the Department") ?></div>

          </div>
        
         <div class="row">
                <div class="col-md-4"><?= $form->field($model, 'dep_phone')->textInput(['maxlength' => 20])->label("Contact No.") ?></div>

                <div class="col-md-4"><?= $form->field($model, 'dep_ext')->textInput(['maxlength' => 20])->label("Extension No.") ?></div>

                <div class="col-md-4"><?= $form->field($model, 'dep_fax')->textInput(['maxlength' => 30])->label("Fax No.") ?></div>
         </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'dep_address_line1')->textInput(['maxlength' => 255])->label("Address") ?></div>

            <div class="col-md-2"><?= $form->field($model, 'dep_city')->textInput(['maxlength' => 50])->label("City") ?></div>

            <div class="col-md-2"><?= $form->field($model, 'dep_pin')->textInput(['maxlength' => 10])->label("Pin Code") ?></div>

            <div class="col-md-2"><?= $form->field($model, 'dep_state')->textInput(['maxlength' => 25])->label("State") ?></div>
        </div>
        <div class="row">
                <div class="col-md-4"><?= $form->field($model, 'dep_hod_photo')->fileInput()->label("HOD Image") ?></div>

                <div class="col-md-4"><?= $form->field($model, 'dep_logo')->fileInput()->label("Department Logo") ?></div>
       
                <div class="col-md-4"><?= $form->field($model, 'dep_bulletin')->fileInput()->label("Bulletin") ?></div>

        </div>    
        <div class="row" style="padding:20px;">
            
            <?= $form->field($model, 'profile')->widget(TinyMce::className(), [
            'options' => ['rows' => 6],
            'language' => 'es',
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            ]
            ]);?>
        </div>

    
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
