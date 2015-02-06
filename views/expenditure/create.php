<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */

$this->title = 'Add Expenditure';
$this->params['breadcrumbs'][] = ['label' => 'Expenditures', 'url' => ['userindex']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-create space back  ">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('create_form', [
        'model' => $model,
     
    ]) ?>

</div>
