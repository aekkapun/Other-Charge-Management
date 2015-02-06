
    <?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expenditure */

$this->title = 'Update'.' '. $model->outstnd_adv.': ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Expenditures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenditure-update space back">

    <h3 class="headings"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('user_form', [
        'model' => $model,
       // 'modelstl' =>$modelstl,
    ]) ?>

</div>
<script type="text/javascript">


        var dep =   document.getElementById("expenditure-dep_id").innerHTML;        
        var year = document.getElementById("expenditure-finance_year").value;
        var budgethead = document.getElementById("expenditure-bh_name").value;
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var object = JSON.parse(xmlhttp.responseText);
        
        document.getElementById("amount").innerHTML = object.amount;
        document.getElementById("expend").innerHTML = object.expend;
        document.getElementById("balance").innerHTML = object.balance;
        document.getElementById("a").innerHTML = object.advance;
        
        
        bl = parseFloat(object.balance);
               
            }
        }
       
        xmlhttp.open("GET", "queryup?yr=" + year + "&dep=" + dep + "&bh=" + budgethead, true);
        xmlhttp.send();
</script>
