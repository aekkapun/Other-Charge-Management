<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\YearsTbl;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BudgetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Budgets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-index">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
<?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?>
 <?php $dataCategory2=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name'); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'dep_id',
            //'year',
            [   
        'format' => 'html',
        'attribute' => 'year',
        'value' => 'year',
        'contentOptions'=>['style'=>'width: 120px;'],
        'filter'=> Html::activeDropDownList($searchModel, 'year', $dataCategory1, 
                $options=['prompt'=>"All Years",
                    'class'=>'btn drpdwn',
                    ]),
        ],
            'date_order',
            'file_ref_no',
            // 'budget_head',
            [   
            'format' => 'html',
            'attribute' => 'budget_head',
            'value' => 'budget_head',
            'contentOptions'=>['style'=>'width: 170px;'],
            'filter'=> Html::activeDropDownList($searchModel, 'budget_head', $dataCategory2, 
                    $options=['prompt'=>"All Bud. Heads",
                        'class'=>'btn drpdwn',
                        ]),
            ],
             'bh_fund',
             'deduction',
             'bh_netfund',
             'bh_desc:ntext',
            // 'user_id',
             //'timestamp',
             //'source_ip',

            
        ],
    ]); ?>

</div>
