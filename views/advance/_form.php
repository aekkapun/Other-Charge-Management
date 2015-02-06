<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Advance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'exp_id')->textInput() ?>

    <?= $form->field($model, 'dep_id')->textInput() ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'bh_name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'status_adv')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <?= $form->field($model, 'source_ip')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
