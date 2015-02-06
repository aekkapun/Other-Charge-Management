<?php

use yii\helpers\url;

?>
<?php
if($status==0){
	$status="Pending";
}
if($status==1){
	$status="Approved";
}
if($status==2){
	$status="Rejected";
}
if($status==3){
	$status="Returned with objection";
}
?> 

<div class="row"> <span class="col-md-3">  OCR No: </span><span class="col-md-3" style="color:#4422EE;"><?= $id ?></span></div><br>
<div class="row"> <span class="col-md-3">  Financial Year: </span><span class="col-md-3" style="color:#4422EE;"><?= $year ?></span></div><br>
<div class="row"> <span class="col-md-3">  Budget Head: </span><span class="col-md-3" style="color:#4422EE;"><?= $bh_name ?></span></div><br>
<div class="row"> <span class="col-md-3">  Bill No.: </span><span class="col-md-3" style="color:#4422EE;"><?= $bill_no ?></span></div><br>
<div class="row"> <span class="col-md-3">  Bill Date: </span><span class="col-md-3" style="color:#4422EE;"><?= $bill_date ?></span></div><br>
<div class="row"> <span class="col-md-3">  Bill Diary No.: </span><span class="col-md-3" style="color:#4422EE;"><?= $bill_diary ?></span></div><br>
<div class="row"> <span class="col-md-3">  Status: </span><span class="col-md-3" style="color:#4422EE;"><?= $status ?></span></div><br>
<div class="row"> <span class="col-md-3">  Remark: </span><span class="col-md-3" style="color:#4422EE;"><?= $remark ?></span></div>
<br>

