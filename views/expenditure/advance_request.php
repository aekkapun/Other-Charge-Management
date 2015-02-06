<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DeptDetails;
use app\models\YearsTbl;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpenditureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Advance Request';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="expenditure-index">

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

            'id',
            //'dep_id',
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
                    $options=['prompt'=>"All Departments",
                        'class'=>'btn drpdwn',
                        ]),
            ],
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
                         //   'advance_status',
             'drawn_on',
            // 'bill_date',
            // 'bill_no',
            // 'bill_diary_no',
            // 'payment_info',
            // 'desc:ntext',
           //  'outstnd_adv',

//                [   
//            'format' => 'html',
//            'attribute' => 'status',
//           // 'value' => 'status',
//            'value' => function($data) {
//            if($data->status == 0){
//                return ('Pending');
//            }
//            if($data->status == 1){
//                return ('Approved');
//            }
//            if($data->status == 2){
//                return ('Rejected');
//            }
//            if($data->status == 3){
//                return ('Retuned with Objection');
//            }
//        },
//            'filter'=> Html::activeDropDownList($searchModel, 'status',
//    ['0' => 'Pending', '1'=>'Approved','2' =>'Rejected','3'=>'Returned with Objection'],
//                    $options=['prompt'=>"All Status",
//                        'class'=>'btn drpdwn',
//                        ])
//            ],
//                'status',
            // 'remark:ntext',
            // ' timestamp',
            // 'source_ip',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
                
        ],
    ]); ?>

</div>
