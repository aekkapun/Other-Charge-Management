<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OcrEntry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ocr-entry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dep_id')->textInput() ?>

    <?= $form->field($model, 'finance_year')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'opening_ammount')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'total_expend')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'avail_bal')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <?= $form->field($model, 'source_ip')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
