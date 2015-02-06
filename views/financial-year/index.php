<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DeptDetails;
use app\models\YearsTbl;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FinancialYearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Financial Years';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="financial-year-index">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Financial Year', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
  
<?php $dataCategory=ArrayHelper::map(DeptDetails::find()->asArray()->all(), 'dept_id', 'dep_name'); ?>
<?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
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
            //'dep_id',
          //  'year',
             [   
        'format' => 'raw',
        'attribute' => 'year',
        'value' => 'year',
        'filter'=> Html::activeDropDownList($searchModel, 'year', $dataCategory1, 
                $options=['prompt'=>"All Years",
                    'class'=>'btn drpdwn',
                    ]),
        ],         
           ['format'=>'html',
               'attribute'=>'total_fund',
               'value'=>'total_fund',
               'label'=>'Total Fund'], 
//'total_fund',
           
            'desc:ntext',
            // 'user_id',
            // 'dep_hod',
            // 'timestamp',
            // 'source_ip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
