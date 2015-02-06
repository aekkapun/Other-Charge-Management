<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OcrEntry */

$this->title = 'Update Ocr Entry: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ocr Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ocr-entry-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
