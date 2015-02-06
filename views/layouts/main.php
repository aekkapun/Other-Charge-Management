<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Alert;
use app\models\DeptDetails;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    
<!-- Load c3.css -->
<link href="/ocm/web/css/c3.css" rel="stylesheet" type="text/css">
<link href="/ocm/web/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Load d3.js and c3.js -->
<script src="/ocm/web/js/d3.v3.min.js" charset="utf-8"></script>
<script src="/ocm/web/js/c3.min.js"></script>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>

.panel-title{
font-size: 14px;
    line-height: 1.42857;
color:#002E52;
}
	.panel-body{
		background-color: #fff;
	}
	.panel{
		margin:10px ;
		background-color: #d9edf7;
	}
	.panel-default > .panel-heading {

	    background-color: #EBF6FF;
	    border-color: #9ACFEA;
	    color: #207097;
	    border-radius: 2px;
text-transform:capitalize;


	}
.panel a{
text-decoration:none;
}
         .modal-dialog{
            width: 90%;
           
        }
        .bor1{
            border-right:  1px solid #000; 
            border-left:  1px solid #000; 
            
        }
        .bor{
             
            border-right:  1px solid #000; 
            
        }
        .big-box{
            color: #002d6e;
            margin: 3px;
        }
        .small-box{
            color: #421c52;
            font-weight: bold; padding: 3px;
        }
        table >thead > tr >td {
            text-align: center;
        }
        table >tbody > tr >td {
            text-align: right; 
        }
        .water{
           opacity:0.09; 
           font-size:20em;
           text-align:center;
           margin:150px 0 0 200px; 
           font-family:'Helvetica Neue',Helvetica,Arial,sans-serif; 
           transform:rotate(315deg);
            -ms-transform:rotate(315deg);
            -webkit-transform:rotate(315deg);
            z-index: -1;
            position: absolute;
            
        }
        .table-striped > thead > tr > th,
        .table-bordered > thead > tr > th{
            text-align: center;
        }
        
        .grid-view > table{
         
            text-align: right;
        }
        .rite{
            text-align: right;
        }
        .drpdwn{
            width:100%; 
            background-color:#fff; 
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        }
        title{
            background-color: #f0f1ff;
        }
        /*******************************************************************/
         .dataTables_wrapper{        
            top:30px;
         } 
    
          #pageshare {
              position:fixed; 
              bottom:50%; 
              right:10px; 
              float:left; 
              border: 1px solid black; 
              border-radius:5px;
              -moz-border-radius:5px;
              -webkit-border-radius:5px;
              background-color:#006699;
              padding:0 0 6px 0;z-index:10; 
          }

        #pageshare .sbutton {
            float:left;
            clear:both;
            margin:5px 5px 0 5px; 
        }
        /*******************************************************************/
      
        .footer{
           
            background-color: #f1f0ff;
            
        }
        .navbar-inverse .navbar-brand {
            color: #DCAE4B;
            font-weight: bold;
        }
        .hidelabel{
            display:none;
        }
        
        .users{
            background-color: #ffc285;         
          /*border: 1px solid #421c52;*/
          border-radius: 3px;

           
        }
      .users  a{
color: #421c52;
text-decoration:none;
}
.users a:hover{
color:#f00;
}
        .users .head{
            border-radius: 3px 3px 0 0;
            border-bottom:1px solid #fff;
            height:40px;
	    padding:9px;
            background-color: #ffc285;
            color: #000;
            text-align: center;
		font-size:14px;
          
        }
.user-default-login .form-horizontal{
margin:10px;
}
        .navbar-inverse .navbar-nav > .active > a,
        .navbar-inverse .navbar-nav > .active > a:hover,
        .navbar-inverse .navbar-nav > .active > a:focus {
            background: #421c52;
        }
        nav .navbar-inverse,
        .navbar
        {
            background-color: #421c52;
            
        }
        .navocm{
            
            font-size: 1.0em;
            background-color: #f0f1ff;
            width: 100%;
        }
        
        .navocm > li > a
        {
           padding: 10px 10px 10px 10px;
        }
        .blocks{
            color: #fff;
           // border: 5px solid #421c52;
            border-radius: 5px;
            min-height: 150px;
            text-align: center;
            padding: 10px ;
            margin: 10px -5px 10px -5px;
        }
        .box a{
            text-decoration: none
        }
        .ui-datepicker-trigger{
            display:none;
        }
        .txthead{
            font-weight: bold; 
            //padding:0 15px 0 15px;
            padding: 5px;
            text-align: left; 
            //line-height: 208%;
           // margin-top: -3px;
            text-wrap:normal
        }
        .hasDatepicker,
        .rdbox{
           // text-wrap:normal;
           //width:100%;
          // background-color: #fff;
    //background-image: none;
    //border: 1px solid #ccc;
   // border-radius: 4px;
    //box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    color: #1316DD;
    //display: block;
    font-size: 14px;
   // height: 34px;
   // line-height: 1.42857;
   // padding: 6px 12px;
    //transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    
        }
        .headings{
            background: #421c52;
            color:#fff;
            border-radius: 5px;
            text-align: center;
            padding: 5px 0 5px 0;
        }
        .back{
           // background: #f1f0ff;
        }
        .space{
            padding: 5px 15px 5px 15px;
        }
    </style>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        if( Yii::$app->user->can("admin")){
            NavBar::begin([
                'brandLabel' => 'Other Charge Management',
                'brandUrl' => Yii::$app->request->BaseUrl.'/index.php/site/admin',
                
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/admin']],
                    ['label' => 'Departments', 'url' => ['/user/admin']],
		    ['label' => 'Content', 'url' => ['/cms/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/user/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->email . ')',
                            'url' => ['/user/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    
                ],
            ]);
            NavBar::end();
        }
        else{
//             if (!\Yii::$app->user->isGuest) {
//            $ide = Yii::$app->user->identity->id;
//             $rowe=(new \yii\db\Query())
//                    ->select('*')
//                    ->from('dept_details') 
//                    ->where(['dept_id'=>$ide])
//                    ->all();
//             $idd = $rowe[0]['id'];
//             $name = $rowe[0]['dep_name'];
//             $url = '/dept-details/view?id='.$idd;
//             }
//             else{
//             $url='#';
//             $name='';
//             }
            NavBar::begin([
                'brandLabel' => 'Other Charge Management',
                'brandUrl' => Yii::$app->homeUrl.'/site/index',
                
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    
                    ['label' => 'Home', 'url' => ['/site/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/user/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->email . ')',
                            'url' => ['/user/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();?>

        <?php
          
            
        }
        ?>

        <div class="container">
            <?php 
            if (!\Yii::$app->user->isGuest) {
            if( Yii::$app->user->can("admin")){  ?>
            <div class="row collapse navbar-collapse" >
                 
                <div class="navocm navbar-nav  nav" >
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/site/admin'?>">
                   
                <i class="fa fa-home ">&nbsp;</i>Home
                    
            </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/financial-year/index'?>">
                   
                        Financial Years
                    
            </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget/index'?>">
                   
                        Allocate Budget
                    
                </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/ocr-entry/index'?>">
                    
                        OCR Entries
                   
                </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget-head-status/index'?>">
                    
                         Budget Head Statuses
                   
                </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/index'?>">
                    
                        Expenditures
                   
                </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/all-advance'?>">
                   
                        Advances
                    
                </a></li>
        <li>
            <div class="dropdown" >
            <button style="margin-top:3px; background-color: #f1f0ff; border:none; color:#337ab7;" 
                    class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                    Department Reports
                    <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" >
            <?php 
            $rown =(new \yii\db\Query())
                ->select('*')
                ->from('dept_details')
                ->all();   
                foreach ($rown as $i=>$row){?>
                 <li role="presentation">
                     <a role="menuitem" id="<?php echo $row['dept_id']?>" tabindex="-1" 
                    href="<?php echo Yii::$app->request->BaseUrl.'/index.php/site/reportadmin?id='.$row['dept_id']?>"><?php echo $row['dep_name'] ?>
                     </a>
                 </li>   
               <?php }
            ?>
            </ul>
            </div>
        </li>
        <li>
            <div class="dropdown" >
            <button style="margin-top:3px; background-color: #f1f0ff; border:none; color:#337ab7;"
                    class="btn btn-default dropdown-toggle" type="button" id="menu1" 
                    data-toggle="dropdown">
                            Master Reports
                        <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" >
            <?php 
            $rown =(new \yii\db\Query())
                ->select('*')
                ->from('dept_details')
                ->all();   
                foreach ($rown as $i=>$row){?>
                 <li role="presentation">
                     <a role="menuitem" id="<?php echo $row['dept_id']?>" tabindex="-1" 
                     href="<?php echo Yii::$app->request->BaseUrl.'/index.php/site/master-report-admin?id='.$row['dept_id']?>">
                                                <?php echo $row['dep_name'] ?>
                     </a>
                 </li>   
               <?php }
            ?>
            </ul>
            </div>
         </li>
         <li>
             <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/site/map'?>">
                 <i class="fa fa-bar-chart fa-1x"></i>
             </a>
         </li>

        
                
    </div>          
        </div> 
     <?php    }
        else{
            ?>
                    <div class="collapse navbar-collapse">
    <div class="navocm navbar-nav  nav" >
        <li> <a href="<?php echo Yii::$app->homeUrl.'/site/index'; ?>">
                   
                <i class="glyphicon glyphicon-home">&nbsp;</i>
                    
            </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/financial-year/userindex'?>">
                   
                        Financial Years
                    
            </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget/userindex'?>">
                   
                        Budget
                    
                </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/ocr-entry/userindex'?>">
                    
                        OCR Entries
                   
                </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget-head-status/userindex'?>">
                    
                         Budget Head Statuses
                   
                </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/userindex'?>">
                    
                        Expenditures
                   
                </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/expenditure/all-advance-user'?>">
                   
                        Advances
                    
                </a></li>
        <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/budget-transfer/userindex'?>">
                   
                        Budget Transfer
                    
                </a></li>
                <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/site/reportuser'?>">
                   
                        Reports
                    
                </a></li>
                 <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/site/master-report'?>">
                   
                        Master Reports
                    
                </a></li>
           <?php      $ide = Yii::$app->user->identity->id;
             $rowe=(new \yii\db\Query())
                    ->select('*')
                    ->from('dept_details') 
                    ->where(['dept_id'=>$ide])
                    ->all();
             $idd = $rowe[0]['id'];?>
                <li> <a href="<?php echo Yii::$app->request->BaseUrl.'/index.php/dept-details/view?id='.$idd?>">
                   
                        Department
                    
                </a></li>
                
                
        
    </div>
        </div> 
            <?php 
        }
            }
        
            ?>
            <?php // Breadcrumbs::widget([
//               'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//            ]) ?>
             
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; PNS <?= date('Y') ?></p>
            <p class="pull-right"><?php echo" Powered By: IIC" ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
    <script>
        
         $(document).ready(function(){
                  $(document).on('click', '.date', function () {
 
                  $(this).datepicker( 'destroy' ).datepicker({
                      showOn:'focus',
                      changeYear:'true', 
                      changeMonth:'true', 
                      dateFormat:'dd-mm-yy'}).focus();
                });
        $('#printbtn').hide();
        $('#exp-ch').hide();
        $('#ocr-ch').hide();
        $('#bhs-ch').hide();
        $('#adv-ch').hide();
             var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("noti").innerHTML = xmlhttp.responseText;
                var not = xmlhttp.responseText;              
                if( not == "sorry" ){
                  $(".not-box").hide();
                }
            }
        }
        xmlhttp.open("GET", "not", true);
        xmlhttp.send();
         })

        var x=document.getElementById("key");
        var y= parseInt(x.innerHTML);
       var amount;
       var expenditure;
        var sum = 0;
        var dedsum = 0;
        var bl;
        
        function showHod(){
        var depid = parseInt($('#financialyear-dep_id').val());
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("financialyear-dep_hod").value = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "query?depid=" + depid , true);
        xmlhttp.send();
        }
        
        function hello(abc){
             var budgethead= abc;         
             var dep =   document.getElementById("dep").innerHTML;      
             var year = document.getElementById('year').innerHTML;
   
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
                var obj = xmlhttp.responseText;
                document.getElementById("a").innerHTML = obj;
                    }
        }
       
        xmlhttp.open("GET", "queryad?yr=" + year + "&dep=" + dep + "&bh=" + budgethead, true);
        xmlhttp.send();
        
            
        }
        
        function showExpend(abc){
          var budgethead= abc; 
            var dep =   document.getElementById("dep").innerHTML; 
            var year = document.getElementById("year").innerHTML;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var object = JSON.parse(xmlhttp.responseText);

            document.getElementById("amount").innerHTML = object.amount;
            document.getElementById("expend").innerHTML = object.expend;
            document.getElementById("balance").innerHTML = object.balance;
            bl = parseFloat(object.balance);
                }
            }
            xmlhttp.open("GET", "query?yr=" + year + "&dep=" + dep + "&bh=" + budgethead, true);
            xmlhttp.send();      
        }
        
        function checkAmount() {
            var bill = document.getElementById("expenditure-bill_amount").value;
            if (bl < bill){
                $('.amount').html("Amount exceeds");
            }
            else{
                $('.amount').html("");
            }
        }
        
       function showUser() {
            var year = $('#budget-0-year').val();
            var depid = parseInt($('#budget-0-dep_id').val());
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                     amount = parseInt(xmlhttp.responseText);
                }
            }
            xmlhttp.open("GET", "query?yr=" + year + "&dep=" + depid, true);
            xmlhttp.send();
        }

        $('input').keyup(function(){ 
   
            for(var i=0; i<=y; i++){
               window["text" + i ] = parseInt($('#one'+i).val());
            }
             
            for(var i=0, sum=0; i<=y; i++){
                sum = sum + window["text" + i];
                if (amount == sum){
                    $('.added3').html("");
                }
                else{
                    $('.added3').html("sum not matched");
                 }
            }
         
            for(var i=0; i<=y; i++){
                  window["ded" + i ] = parseFloat($('#two'+i).val());
                  window["net" + i ] =parseFloat( ((100- window["ded" + i ])/100)* window["text" + i ]);
                  document.getElementById("three"+i).value =  window["net" + i ].toFixed(2);
            }
            for(var i=0, dedsum=0; i<=y; i++){
                var dfg = parseFloat(window["net" + i].toFixed(2));               
                 dedsum = dedsum + dfg;
            }
             $('#added').html(sum);             
             $('#added1').html(dedsum);
        
        
        });
          
      
      
    </script>
        
	


<!-- CSS and Js for RTF-->
    <link rel="stylesheet" type="text/css" href="/ocm/web/css/rtf/jquery.cleditor.css" />
    <script type="text/javascript" src="/ocm/web/js/rtf/jquery.cleditor.js"></script>
    <script type="text/javascript" language="javascript" src="/ocm/web/js/MultiplePop/script.js"></script>	
<script type="text/javascript" language="javascript" src="/ocm/web/js/nano.js"></script>	
    
   
    <script type="text/javascript" src="/ocm/web/js/rtf/jquery.cleditor.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="/ocm/web/css/MultiplePop/demo.css" /> 	
    <link rel="stylesheet" type="text/css" href="/ocm/web/css/style.css" /> 
<link rel="stylesheet" type="text/css" href="/ocm/web/css/nano.css" /> 	
</body>
</html>
<?php $this->endPage() ?>
