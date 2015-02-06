<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FinancialYear */

$this->title = 'Add Financial Year';
$this->params['breadcrumbs'][] = ['label' => 'Financial Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="financial-year-create back space">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
