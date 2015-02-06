<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FinancialYear */
 $user_id = Yii::$app->user->identity->id;
 echo $user_id;
$this->title = $user_id;
$this->params['breadcrumbs'][] = ['label' => 'Financial Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $rows=(new \yii\db\Query())
        ->select('*')
        ->from('financial_year_tbl')
        ->where(['dep_id'=> $user_id])
        ->all();
var_dump($rows);
?>
