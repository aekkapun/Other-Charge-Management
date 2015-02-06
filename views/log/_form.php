<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Log */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dep_id')->textInput() ?>

    <?= $form->field($model, 'finance_year')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'bh_name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'bill_amount')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'bill_date')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'bill_no')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'bill_diary_no')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'payment_info')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'outstnd_adv')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <?= $form->field($model, 'source_ip')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
