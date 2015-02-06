<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DeptDetails;
use app\models\YearsTbl;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\OcrEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ocr Entries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ocr-entry-index">

    <h3 class="headings"> <?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 <?php $dataCategory=ArrayHelper::map(DeptDetails::find()->asArray()->all(), 'dept_id', 'dep_name'); ?>
<?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?>   

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
                $options=['prompt'=>"-Select Department-",
                    'class'=>'btn drpdwn',
                    ]),
        ],
            //'finance_year',
            [   
        'format' => 'html',
        'attribute' => 'finance_year',
        'value' => 'finance_year',
        'filter'=> Html::activeDropDownList($searchModel, 'finance_year', $dataCategory1, 
                $options=['prompt'=>"Year",
                    'class'=>'btn drpdwn',
                    ]),
        ],
            'opening_ammount',
            'total_expend',
            'avail_bal',
            // 'timestamp',
            // 'source_ip',
            // 'user_id',

           
        ],
    ]); ?>

</div>
