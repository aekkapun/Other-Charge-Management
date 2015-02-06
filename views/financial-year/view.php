<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="financial-year-view">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

    <div class="col-md-12" style="margin-top: 30px;">
       <div class="row">
    <div class="col-md-6 col-md-offset-3">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'dep_id',
            'year',
            'total_fund',
            'desc:ntext',
//            'user_id',
            'dep_hod',
//            'timestamp',
//            'source_ip',
        ],
    ]) ?>
    </div>
       </div>
       <div class="col-md-12 col-md-offset-5">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p></div></div>
</div>
