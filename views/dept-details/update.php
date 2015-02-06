<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeptDetails */

$this->title = 'Update Department Details ' . ' ' ;
$this->params['breadcrumbs'][] = ['label' => 'Dept Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dept-details-update">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
