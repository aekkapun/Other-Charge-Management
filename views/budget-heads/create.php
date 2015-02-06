<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BudgetHeads */

$this->title = 'Create Budget Heads';
$this->params['breadcrumbs'][] = ['label' => 'Budget Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-heads-create space back">

    <h3 class="heading"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
