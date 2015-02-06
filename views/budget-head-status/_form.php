<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BudgetHeadStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="budget-head-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'dep_id')->textInput() ?>

    <?= $form->field($model, 'bh_name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'bh_total_amount')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'bh_expend')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'bh_balance')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
