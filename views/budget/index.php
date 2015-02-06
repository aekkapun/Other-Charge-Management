<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DeptDetails;
use app\models\YearsTbl;
use yii\helpers\ArrayHelper;
use app\models\BudgetHeads;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BudgetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Budgets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-index">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Budget', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
<?php $dataCategory=ArrayHelper::map(DeptDetails::find()->asArray()->all(), 'dept_id', 'dep_name'); ?>
<?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?>
     <?php $dataCategory2=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name'); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
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
                $options=['prompt'=>"All Departments",
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
//                        [   
//        'format' => 'raw',
//        'attribute' =>'date_order',
//        'value' => 'date_order',
//        'filter'=> DatePicker::widget([
//            'model'=>$searchModel,
//           
//            'name' =>'date_order',
//            'attribute' =>'date_order',
//            'clientOptions'=>[
//                'showOn'=> 'both',
//               
//               'dateFormat'=>'dd/mm/yyyy',
//                
//                'changeYear'=>true,
//                'changeMonth'=>true,
//                'yearRange'=>'2000:2050',
//                'htmlOptions'=>['value'=>'','placeholder'=>'', 'style'=>'display:none']
//                ],
//            
//        ]),
//        ],
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
             //'bh_desc:ntext',
            // 'user_id',
             //'timestamp',
             //'source_ip',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
