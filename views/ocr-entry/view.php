<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OcrEntry */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ocr Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ocr-entry-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'finance_year',
            'opening_ammount',
            'total_expend',
            'avail_bal',
            'timestamp',
            'source_ip',
            'user_id',
        ],
    ]) ?>

</div>
