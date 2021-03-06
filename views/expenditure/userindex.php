<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\YearsTbl;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpenditureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expenditures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-index">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Expenditure', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Draw Advance', ['draw-advance'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?>
    <?php $dataCategory2=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name'); ?>
    <?php    Pjax::begin(); ?>
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
            // 'bill_diary_no',
             //'payment_info',
            // 'desc:ntext',
            'outstnd_adv',
            [   
            'format' => 'html',
            'attribute' => 'status',
           // 'value' => 'status',
            'value' => function($data) {
            if($data->status == 0){
                return ('Pending');
            }
            if($data->status == 1){
                return ('Approved');
            }
            if($data->status == 2){
                return ('Rejected');
            }
            if($data->status == 3){
                return ('Retuned with Objection');
            }
        },
            'filter'=> Html::activeDropDownList($searchModel, 'status',
    ['0' => 'Pending', '1'=>'Approved','2' =>'Rejected','3'=>'Returned with Objection'],
                    $options=['prompt'=>"All Status",
                        'class'=>'btn drpdwn',
                        ])
            ],
             
             
             //'remark:ntext',
            // ' timestamp',
            // 'source_ip',
            // 'user_id',
//                [
//                    'format' => 'html',
//            'attribute' => 'advance_status',
//           // 'value' => 'status',
//            'value' => function($data) {
//            if($data->advance_status == 0){
//                return ('Unsettled');
//            }
//            if($data->advance_status == 1){
//                return ('Settled');
//            }
//            
//        },
//                ],
              //  'drawn_on',
               // 'settled_on',
 
            ['class' => 'yii\grid\ActionColumn',                
                'template' => '{view} {delete} {update}',                
                'buttons' => [
                    'update' => function ($url, $model){
                        if (!(($model->outstnd_adv == 'Expenditure' && $model->status == 1)||
                        ($model->outstnd_adv == 'Advance' && $model->status == 1 && $model->advance_status == 1))){
                            return Html::a('', $url,
                                         [ 'title' => Yii::t('app', 'Update'), 'class'=>'glyphicon glyphicon-pencil', ]) ;
                        }

                        else{
                            return ' ';
                        }
                    },
                    'delete' => function ($url, $model){                    
                        if (!($model->outstnd_adv == 'Expenditure' && $model->status == 1) &&
                                !($model->outstnd_adv == 'Advance' && $model->status == 1 && $model->advance_status == 1)
                                ){
                            return Html::a('',['delete','id'=>$model->id],
                                            [
                                        'class'=>'glyphicon glyphicon-trash',
                                        'data'=>[
                                           'confirm'=> 'Are you sure you want to delete this item?',
                                           'method'=>'post'],
                            ]);


                        }
                         else{}
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
