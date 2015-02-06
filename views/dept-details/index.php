<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeptDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dept Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dept-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dept Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dept_id',
            'dep_name',
            'dep_email:email',
            'dep_phone',
            // 'dep_ext',
            // 'dep_fax',
            // 'dep_hod',
            // 'profile:ntext',
            // 'dep_address_line1',
            // 'dep_city',
            // 'dep_pin',
            // 'dep_state',
            // 'dep_year',
            // 'dep_hod_photo',
            // 'dep_logo',
            // 'dep_website',
            // 'dep_bulletin',
            // 'ip',
            // 'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
