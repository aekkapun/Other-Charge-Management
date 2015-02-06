<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\YearsTbl;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OcrEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ocr Entries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ocr-entry-index">

   <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

<?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            //'dep_id',
           // 'finance_year',
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
