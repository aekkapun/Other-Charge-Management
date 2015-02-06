<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FinancialYear */
 $rowe=(new \yii\db\Query())
                    ->select('*')
                    ->from('dept_details') 
                    ->where(['dept_id'=>$model->dep_id])
                    ->all(); 
          
 $name = $rowe[0]['dep_name'];
$this->title = 'Financial Year:'.$name;
$this->params['breadcrumbs'][] = ['label' => 'Financial Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="financial-year-update">

    <h3 class="headings "><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
