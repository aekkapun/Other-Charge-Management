<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DeptDetails;
use app\models\YearsTbl;
use yii\helpers\ArrayHelper;
use app\models\BudgetHeads;


/* @var $this yii\web\View */
/* @var $searchModel app\models\BudgetHeadStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Budget Head Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-head-status-index">

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
            'contentOptions'=>['style'=>'width: 150px;'],
            'filter'=> Html::activeDropDownList($searchModel, 'dep_id', $dataCategory, 
                    $options=['prompt'=>"All Departments",
                        'class'=>'btn drpdwn',
                        ]),
            ],
            'bh_name',
                             [   
            'format' => 'html',
            'attribute' => 'bh_name',
            'value' => 'bh_name',
            'contentOptions'=>['style'=>'width: 170px;'],
            'filter'=> Html::activeDropDownList($searchModel, 'bh_name', $dataCategory2, 
                    $options=['prompt'=>"All Bud. Heads",
                        'class'=>'btn drpdwn',
                        ]),
            ],
            'bh_total_amount',
            'bh_expend',
            'bh_balance',
            'bh_advance',
            // 'timestamp',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
