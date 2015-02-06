<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

 
<?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?>  

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
        'filter'=> Html::activeDropDownList($searchModel, 'year', $dataCategory1, 
                $options=['prompt'=>"All Years",
                    'class'=>'btn drpdwn',
                    ]),
        ],      
            'total_fund',
            'desc:ntext',
            // 'user_id',
            // 'dep_hod',
            // 'timestamp',
            // 'source_ip',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
