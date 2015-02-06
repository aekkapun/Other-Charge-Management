<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BudgetHeadStatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="budget-head-status-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'dep_id') ?>

    <?= $form->field($model, 'bh_name') ?>

    <?= $form->field($model, 'bh_total_amount') ?>

    <?php // echo $form->field($model, 'bh_expend') ?>

    <?php // echo $form->field($model, 'bh_balance') ?>
    
    <?php // echo $form->field($model, 'bh_advance') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
