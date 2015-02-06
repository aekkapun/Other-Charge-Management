<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OcrEntry */

$this->title = 'Create Ocr Entry';
$this->params['breadcrumbs'][] = ['label' => 'Ocr Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ocr-entry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
