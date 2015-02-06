<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BudgetHeads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="budget-heads-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">

        <div class="col-md-3"><?= $form->field($model, 'bh_name')->textInput(['maxlength' => 20]) ?></div>

        <div class="col-md-9"><?= $form->field($model, 'bh_description')->textarea(['rows' => 6]) ?></div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
