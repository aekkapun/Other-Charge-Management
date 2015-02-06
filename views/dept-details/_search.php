<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeptDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dept-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dept_id') ?>

    <?= $form->field($model, 'dep_name') ?>

    <?= $form->field($model, 'dep_email') ?>

    <?= $form->field($model, 'dep_phone') ?>

    <?php // echo $form->field($model, 'dep_ext') ?>

    <?php // echo $form->field($model, 'dep_fax') ?>

    <?php // echo $form->field($model, 'dep_hod') ?>

    <?php // echo $form->field($model, 'profile') ?>

    <?php // echo $form->field($model, 'dep_address_line1') ?>

    <?php // echo $form->field($model, 'dep_city') ?>

    <?php // echo $form->field($model, 'dep_pin') ?>

    <?php // echo $form->field($model, 'dep_state') ?>

    <?php // echo $form->field($model, 'dep_year') ?>

    <?php // echo $form->field($model, 'dep_hod_photo') ?>

    <?php // echo $form->field($model, 'dep_logo') ?>

    <?php // echo $form->field($model, 'dep_website') ?>

    <?php // echo $form->field($model, 'dep_bulletin') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
