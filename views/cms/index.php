<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CmsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Content';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-index">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add content', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'heading',
            'msg:ntext',
   //         'status',
[    
            'format' => 'html',
            'attribute' => 'status',
            'value' => 'status',
          'contentOptions'=>['style'=>'width: 130px;'],
            'filter'=> Html::activeDropDownList($searchModel, 'status',
    ['publish' => 'Published', 'none'=>'None'],
                    $options=['prompt'=>"All Status",
                        'class'=>'btn drpdwn',
                        ])
            ],
           // 'tag',
[    
            'format' => 'html',
            'attribute' => 'tag',
            'value' => 'tag',
          'contentOptions'=>['style'=>'width: 130px;'],
            'filter'=> Html::activeDropDownList($searchModel, 'tag',
    ['alerts' => 'Alerts', 'notification'=>'Notifications'],
                    $options=['prompt'=>"All Status",
                        'class'=>'btn drpdwn',
                        ])
            ],
            // 'file',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
