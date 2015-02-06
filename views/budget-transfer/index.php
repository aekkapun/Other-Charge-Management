<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DeptDetails;
use app\models\YearsTbl;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BudgetTransferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Budget Transfers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-transfer-index">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $dataCategory=ArrayHelper::map(DeptDetails::find()->asArray()->all(), 'dept_id', 'dep_name'); ?>
    <?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?>
    <?php $dataCategory2=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name'); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
           // 'dep_id',
             [   
            'format' => 'html',
            'attribute' => 'dep_id',
            'value' => function($data) {
                    $rown =(new \yii\db\Query())
                            ->select('*')
                            ->from('dept_details')                 
                            ->all();
                    foreach($rown as $key=>$row){
                    if($data->dep_id == $row['dept_id']){
                        return ($row['dep_name']);
                    }
                    }
                    },
            'filter'=> Html::activeDropDownList($searchModel, 'dep_id', $dataCategory, 
                    $options=['prompt'=>"-All Department-",
                        'class'=>'btn drpdwn',
                        ]),
            ],
           // 'year',
                            [   
            'format' => 'html',
            'attribute' => 'year',
            'value' => 'year',
            'filter'=> Html::activeDropDownList($searchModel, 'year', $dataCategory1, 
                    $options=['prompt'=>"All Years",
                        'class'=>'btn drpdwn',
                        ]),
            ],
            //'from_bh',
            [   
            'format' => 'html',
            'attribute' => 'from_bh',
            'value' => 'from_bh',
            'filter'=> Html::activeDropDownList($searchModel, 'from_bh', $dataCategory2, 
                    $options=['prompt'=>"All Bud. Heads",
                        'class'=>'btn drpdwn',
                        ]),
            ],
            //'to_bh',
                            [   
            'format' => 'html',
            'attribute' => 'to_bh',
            'value' => 'to_bh',
            'filter'=> Html::activeDropDownList($searchModel, 'to_bh', $dataCategory2, 
                    $options=['prompt'=>"All Bud. Heads",
                        'class'=>'btn drpdwn',
                        ]),
            ],
            'amount',
            
            //'status',
                            [   
            'format' => 'html',
            'attribute' => 'status',
            'value' => 'status',
            'filter'=> Html::activeDropDownList($searchModel, 'status',
    ['0' => 'Pending', '1'=>'Approved','2' =>'Rejected','3'=>'Returned with Objection'],
                    $options=['prompt'=>"-Status-",
                        'class'=>'btn drpdwn',
                        ])
            ],
                            
                            
                         
            // 'user_id',
            // 'timestamp',
            // 'source_ip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
