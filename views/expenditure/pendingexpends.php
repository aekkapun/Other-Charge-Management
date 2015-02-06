<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\YearsTbl;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpenditureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pending Expenditures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-index">

     <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 <?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?>
    <?php $dataCategory2=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name'); ?>   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'dep_id',
            //'finance_year',
            [   
            'format' => 'html',
            'attribute' => 'finance_year',
            'value' => 'finance_year',
            'filter'=> Html::activeDropDownList($searchModel, 'finance_year', $dataCategory1, 
                    $options=['prompt'=>"All Years",
                        'class'=>'btn drpdwn',
                        ]),
            ],
            //'bh_name',
            [   
            'format' => 'html',
            'attribute' => 'bh_name',
            'value' => 'bh_name',
            'filter'=> Html::activeDropDownList($searchModel, 'bh_name', $dataCategory2, 
                    $options=['prompt'=>"All Bud. Heads",
                        'class'=>'btn drpdwn',
                        ]),
            ],
            'bill_amount',
             'bill_date',
             'bill_no',
             'bill_diary_no',
             'payment_info',
             'desc:ntext',
            // 'outstnd_adv',
            // 'status',
             'remark:ntext',
            // ' timestamp',
            // 'source_ip',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
