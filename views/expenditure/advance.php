<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\DeptDetails;
use app\models\YearsTbl;
use app\models\BudgetHeads;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpenditureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Advances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-index">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <?php   $rown =(new \yii\db\Query())
            ->select('*')
           ->from('expenditure_tbl') 
            ->where(['outstnd_adv'=>'advance'])
            ->all();
   if(empty($rown)){ ?>
       <div style="display:none;" id="no_rows1"  name="no_rows1" ><?php echo 0; ?></div>
<div style="display:none;" id="no_rows"  name="no_rows" ><?php echo 0; ?></div>
<?php   }
   else{
    foreach ($rown as $key=>$row){ ?>
       <div style="display:none;" id="no_rows1"  name="no_rows1" ><?php echo $row['id']; ?></div>  
    <?php }?>
    <div style="display:none;" id="no_rows"  name="no_rows" ><?php echo $row['id']; ?></div>
  <?php }?>
<?php $dataCategory=ArrayHelper::map(DeptDetails::find()->asArray()->all(), 'dept_id', 'dep_name'); ?>
<?php $dataCategory1=ArrayHelper::map(YearsTbl::find()->asArray()->all(), 'year', 'year'); ?>
    <?php $dataCategory2=ArrayHelper::map(BudgetHeads::find()->asArray()->all(), 'bh_name', 'bh_name'); ?>  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'dep_id',
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
            //'bh_name',
                            [   
            'format' => 'html',
            'attribute' => 'bh_name',
            'value' => 'bh_name',
            'filter'=> Html::activeDropDownList($searchModel, 'bh_name', $dataCategory2, 
                    $options=['prompt'=>"--Budget Heads--",
                        'class'=>'btn drpdwn',
                        ]),
            ],
            'bill_amount',
            // 'bill_date',
            // 'bill_no',
            // 'bill_diary_no',
            // 'payment_info',
            // 'desc:ntext',
            // 'outstnd_adv',
            // 'status',
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
                    $options=['prompt'=>"-Status-",
                        'class'=>'btn drpdwn',
                        ])
            ],
            // 'remark:ntext',
            // ' timestamp',
            // 'source_ip',
            // 'user_id',

            [
    'attribute' => 'Mail',
    'format' => 'raw',
    'value' => function ($model) {    
        $rowe=(new \yii\db\Query())
                    ->select('dep_email')
                    ->from('dept_details') 
                    ->where(['dept_id'=> $model->dep_id])
                    ->all();   
            $e1 = $rowe[0]['dep_email'];
            return '<div><input type="checkbox" class="check" name="check[]" id="check'.$model->id.'" value="'.$e1.'">'.
                    ' <input type="hidden" value="'.$e1.'" id="ap_email'.$model->id.'"  name="ap_email'.$model->id.'"'
        ;
           
    },
            
],
        ],
    ]); ?>
   

</div>

<div id='pageshare' title="Send mail to the selected candidate"> 
<div class='sbutton' id='rt'>

<span class="btn-primary"  id="btn_mail" name="btn_continue">Send Mail </span> </div>
</div>


<!--popup content-->
	<div id="popupContainer" class="hidden1">
		<a id="close" class="hidden1" title="close popup"></a>
		<!--<h1>Send Mail</h1>		<form action="<?php //echo $homeUrl.'?r=upload-csv/sendmail' ?>">  content/send_mail.php--> 
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ; //, 'onblur'=>'showCustomer()', 'id'=>'tbl_name' ?>
		<p id="contactArea">
        	To <br>
        	<input type="text" style="width:700px;height:30px;" required id="to" name="email">
			<br/>		
        	Subject <br>
        	<input type="text" style="width:700px;height:30px;" required name="subject">
			<br/>
            Message
            <br>
			 <textarea class="cleditor" required name="message"></textarea> 
			<br>
<!--SMS <input type='text' required="required" name="sms_body" id="sms_body" style="width:660px;">
Remaining Characters	<span id="left" style="color:#421c52;font-weight:bold;"> 160 </span>-->
<input type="hidden" value="<?php echo "";//$_REQUEST[postid];?>" name="postid" />
<input type="hidden" id="form_no" name="form_no" />
<!--                <center><input type="submit" value="Send" class="button" ></center>-->
<div class="form-group">
        <?= Html::submitButton( 'Submit' , ['btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

		</p>
<!--		</form>-->
	</div>
	<div id="overlayEffect">
    </div>
  <!--end popup content--> 

