<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\DeptDetails */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dept Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dept-details-view">

  

   
    <?php
    $rown=(new \yii\db\Query())
            ->select('*')
            ->from('dept_details') 
            ->where(['dept_id'=>Yii::$app->user->identity->id])
            ->all();
?>
    <div class="col-md-12" style="margin-top: 30px; background-color: #feddaa; padding:20px 0 20px 0;
         border: 1px solid #888; border-radius: 5px;">
        <div class="col-md-2">
             <?php $url= Yii::$app->request->BaseUrl.'/';?>
                <img src="<?php echo $url.$rown[0]['dep_logo']  ?>" height="150px" width="150px">
        </div>
        <div class="col-md-8" style="">
           <div class="row">
               <div class="col-md-4 ">
                   <div class="col-md-12 big-box">
                    <div class="col-md-12 small-box">Department Name </div>
                    <div class="col-md-12"><?php echo $rown[0]['dep_name'] ?></div>
                </div>
               </div>
                <div class="col-md-4"><div class="col-md-12 big-box">
                    <div class="col-md-12 small-box">Year of Establishment </div>
                    <div class="col-md-12"><?php echo $rown[0]['dep_year'] ?></div>            
                </div></div>
                <div class="col-md-4"><div class="col-md-12 big-box">
                    <div class="col-md-12 small-box">Department Website</div>
                    <div class="col-md-12"><?php echo $rown[0]['dep_website'] ?></div>
                </div></div>
           </div>
           <div class="row">
                <div class="col-md-4"><div class="col-md-12 big-box">
                    <div class="col-md-12 small-box">Department Email ID</div>
                    <div class="col-md-12"><?php echo $rown[0]['dep_email'] ?></div>
                </div></div>
                <div class="col-md-4"><div class="col-md-12 big-box">
                    <div class="col-md-12 small-box">Head of the Department</div>
                    <div class="col-md-12"><?php echo $rown[0]['dep_hod'] ?></div>
                </div></div>
           </div>
           <div class="row">
                <div class="col-md-4"><div class="col-md-12 big-box">
                        <div class="col-md-12 small-box">Contact No.</div>
                    <div class="col-md-12"><?php echo $rown[0]['dep_phone'] ?></div>
                </div></div>
                <div class="col-md-4"><div class="col-md-12 big-box">
                        <div class="col-md-12 small-box">Extension No.</div>
                    <div class="col-md-12"><?php echo $rown[0]['dep_ext'] ?></div>
                </div></div>
                <div class="col-md-4"><div class="col-md-12 big-box">
                        <div class="col-md-12 small-box">Fax No.</div>
                    <div class="col-md-12"><?php echo $rown[0]['dep_fax'] ?></div>
                </div></div>
           </div>
           <div class="row">
                <div class="col-md-4"><div class="col-md-12 big-box">
                     <div class="col-md-12 small-box">Address</div>
                    <div class="col-md-12">
                        <?php echo $rown[0]['dep_address_line1'] ?><br>
                        <?php echo $rown[0]['dep_city'] ?><br>
                        <?php echo $rown[0]['dep_state'] ?><br>
                        <?php echo $rown[0]['dep_pin'] ?><br>                    
                    </div>
                </div></div>
                <div class="col-md-8"><div class="col-md-12 big-box">
                        <div class="col-md-12 small-box">Profile</div>
                        <div class="col-md-12"><?php echo $rown[0]['profile'] ?></div>
                </div></div>
            
        </div>
            
        </div>
         <div class="col-md-2">
                <?php $url= Yii::$app->request->BaseUrl.'/';?>
                <img src="<?php echo $url.$rown[0]['dep_hod_photo']  ?>" height="150px" width="150px">
            </div>
        
        
        
            
        
    </div>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'col-md-offset-6 btn btn-primary', 'style'=> 'margin-top:10px;']) ?>
        
    </p>
    <?php // DetailView::widget([
//        'model' => $model,
//        'attributes' => [
////            'id',
////            'dept_id',
//            'dep_name',
//            'dep_email:email',
//            'dep_phone',
//            'dep_ext',
//            'dep_fax',
//            'dep_hod',
//            'profile:ntext',
//            'dep_address_line1',
//            'dep_city',
//            'dep_pin',
//            'dep_state',
//            'dep_year',
//            'dep_hod_photo',
//            'dep_logo',
//            'dep_website',
//            'dep_bulletin',
////            'ip',
////            'timestamp',
//        ],
//    ]) ?>

</div>
