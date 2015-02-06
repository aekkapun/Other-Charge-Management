<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Budget */

$this->title = 'Add Budget';
$this->params['breadcrumbs'][] = ['label' => 'Budgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-create space back">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
       
    ]) ?>
    

</div>
