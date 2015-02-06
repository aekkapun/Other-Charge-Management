<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DeptDetails;
use app\models\YearsTbl;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchAdvance */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Advances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advance-index">

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
            'exp_id',
            //'dep_id',
             [   
            'format' => 'html',
            'attribute' => 'dep_id',
            'contentOptions'=>['style'=>'width: 150px;'],
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
                    $options=['prompt'=>"All Depts.",
                        'class'=>'btn drpdwn',
                        ]),
            ],
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
            //'bh_name',
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
                            
            'amount',
            'drawn_on',
                            'settled_on',
            'status_adv',
//             [   
//            'format' => 'html',
//            'attribute' => 'status_adv',
//           // 'value' => 'status',
//            'value' => function($data) {
//            if($data->status_adv == 0){
//                return ('Pending');
//            }
//            if($data->status_adv == 1){
//                return ('Approved');
//            }
//            if($data->status_adv == 2){
//                return ('Rejected');
//            }
//            if($data->status_adv == 3){
//                return ('Retuned with Objection');
//            }
//        },
//            'filter'=> Html::activeDropDownList($searchModel, 'status_adv',
//    ['0' => 'Pending', '1'=>'Approved','2' =>'Rejected','3'=>'Returned with Objection'],
//                    $options=['prompt'=>"-Status-",
//                        'class'=>'btn drpdwn',
//                        ])
//            ],
            // 'timestamp',
            // 'source_ip',
            // 'user_id',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
