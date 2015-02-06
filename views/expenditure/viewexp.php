<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */
if($model->outstnd_adv == 'Expenditure'){
$this->title = 'Expenditure: ' . 'OCR No. '.' ' . $model->id;
}
if($model->outstnd_adv == 'Advance'){
$this->title = 'Advance: ' . ' ' .'OCR No.'.' '. $model->id;  
}
$this->params['breadcrumbs'][] = ['label' => 'Expenditures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-view">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

    
    <div class="col-md-12">
        <div class="col-md-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'dep_id',
            'finance_year',
            'bh_name',
            'bill_amount',
            'bill_date',
           // 'bill_no',
            //'drawn_on',
           // 'bill_diary_no',
           // 'payment_info',
            //'desc:ntext',
            //'outstnd_adv',
            //'status',
            //'remark:ntext',
            //'timestamp',
           // 'source_ip',
           // 'user_id',
        ],
    ]) ?>
    </div>
        <div class="col-md-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            //'dep_id',
            //'finance_year',
            //'bh_name',
            //'bill_amount',
            //'bill_date',
            'bill_no',
            'bill_diary_no',
            'payment_info',
            'desc:ntext',
           // 'outstnd_adv',
            
            [ 'format'=>'raw',
                'attribute' => 'status',
              //  'name'=>'status',
               
           
            'value' =>
                (($model->status == 0)||($model->status == 1))? 
                (($model->status == 0)? '<span>Pending</span>':'<span>Approved</span>')
                :(($model->status == 2)? '<span>Rejected</span>':'<span>Returned with objection</span>')
                ,
//                function($data) {
//                if($data->status == 0){
//                    return ('Pending');
//                }
//                if($data->status == 1){
//                    return ('Approved');
//                }
//                if($data->status == 2){
//                    return ('Rejected');
//                }
//                if($data->status == 3){
//                    return ('Retuned with Objection');
//                }
//        },
                
            ],
            //'advance_status',
           // 'status',
            //'settled_on',
            //'remark:ntext',
            //'timestamp',
           // 'source_ip',
           // 'user_id',
        ],
    ]) ?>
    </div></div>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary col-md-offset-5']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
       ]) ?>
    </p>
</div>
