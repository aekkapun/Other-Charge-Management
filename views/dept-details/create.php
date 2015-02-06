<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeptDetails */

$this->title = 'Department Details';
$this->params['breadcrumbs'][] = ['label' => 'Dept Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dept-details-create back space" >

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
