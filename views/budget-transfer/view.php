<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BudgetTransfer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Budget Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-transfer-view">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dep_id',
            'year',
            'from_bh',
            'to_bh',
            'amount',
            'status',
            'user_id',
            'timestamp',
            'source_ip',
        ],
    ]) ?>

</div>
