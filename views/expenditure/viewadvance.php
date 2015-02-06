<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */

$this->title = 'Settled Advance: ' . ' ' . $model->id;
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
            //'bill_date',
            //'bill_no',
            'drawn_on',
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
            //'bill_no',
           // 'bill_diary_no',
            'payment_info',
            'desc:ntext',
           // 'outstnd_adv',
            
            [ 'format'=>'raw',
                'attribute' => 'status',

            'value' =>
                (($model->status == 0)||($model->status == 1))? 
                (($model->status == 0)? '<span>Pending</span>':'<span>Approved</span>')
                :(($model->status == 2)? '<span>Rejected</span>':'<span>Returned with objection</span>'),

            ],
            //'advance_status',
           // 'status',
            
            'remark:ntext',
            'settled_on',
            //'timestamp',
           // 'source_ip',
           // 'user_id',
        ],
    ]) ?>
    </div><?php 
    $rown =(new \yii\db\Query())
            ->select('*')
           ->from('advance_settle') 
            ->where(['ocr_no'=>$model->id])
            ->all();
    
    ?><div class="col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Bill No</th>
                    <th>Bill Date</th>
                    <th>Bill Diary no</th>
                    <th>Bill Amount</th>
                    <th>Vendor Details</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rown as $key=>$row){ ?>
                <tr>
                    <td><?php echo $row['bill_no']; ?> </td>
                    <td><?php echo $row['bill_date']; ?> </td>
                    <td><?php echo $row['bill_diary']; ?> </td>
                    <td><?php echo $row['bill_amount']; ?> </td>
                    <td><?php echo $row['vendor_details']; ?> </td> 
                    <td><?php echo $row['remarks']; ?> </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
</div>
    
    </div>
    <p>
        <?php // Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary col-md-offset-5']) ?>
        <?php // Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>
</div>
