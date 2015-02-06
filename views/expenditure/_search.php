<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExpenditureSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenditure-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dep_id') ?>

    <?= $form->field($model, 'finance_year') ?>

    <?= $form->field($model, 'bh_name') ?>

    <?= $form->field($model, 'bill_amount') ?>

    <?php // echo $form->field($model, 'bill_date') ?>

    <?php // echo $form->field($model, 'bill_no') ?>

    <?php // echo $form->field($model, 'bill_diary_no') ?>

    <?php // echo $form->field($model, 'payment_info') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'outstnd_adv') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, ' timestamp') ?>

    <?php // echo $form->field($model, 'source_ip') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
