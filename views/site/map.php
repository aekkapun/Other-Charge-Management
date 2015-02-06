<?php 
use yii\helpers\Html;
use app\models\DeptDetails;
use yii\helpers\ArrayHelper;
$this->title = 'Visualisation';
?>  
  <h3 class="headings"><?= Html::encode($this->title) ?></h3>
  
  <div class="col-md-2">
        <select class="form-control" id="yr" onchange="depart()">
          <option  value="all" id="">All Department</option>
          <?php 
            $rown =(new \yii\db\Query())
                ->select('*')
                ->from('dept_details')
                
                ->all();   
                foreach ($rown as $i=>$row){?>
                 
          <option value="<?php echo $row['dept_id']?>" id="dept<?php echo $row['id']?>" >
                     <?php echo $row['dep_name'] ?>
                     
                     </option>
               <?php }  ?>
           
      </select>
  </div>
  <div class="col-md-2">
        <select class="form-control" id="typ" onchange="bud()">
          <option  value="all" id="all">Advance + Expenditure</option>
          <option value="Advance" id="ad" >Advance</option>
          <option value="Expenditure" id="ex" >Expenditure</option>
        </select>
  </div>
<?php 
$mon = date("m");
            if($mon < 04){
                $pyr = date("Y");
                $pyr = $pyr-1;
                $cyr = date("y");
                $year = $pyr.'-'.$cyr;
              
            }
            else{
                $pyr = date("Y");
                $cyr = date("y");
                $cyr = $cyr +1;
                $year = $pyr.'-'.$cyr;
              

            }
?>
<div class="col-md-2 col-md-offset-6"> Year: <span id="year"><?php echo $year ?></span></div>
  <br><br>
 <div id="chart"></div>
 
     
              
  
    <script>
       
            depart();
        
   function depart(){
       var yr = document.getElementById('year').innerHTML;
        var dep = document.getElementById('yr').value;
document.getElementById('typ').value = 'all';
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
          
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                object = JSON.parse(xmlhttp.responseText);
             // alert(object.Expenditure);
               var chart = c3.generate({
        data: {
            x:'x',
          columns: [
                 ['x', 'April', 'May','June', 'July', 'August', 'September', 'October','November','December','January', 'February', 'March',],
                    object.Expenditure,
                    object.Advance,
],
          type: 'bar',
          onclick: function (d, element) { console.log("onclick", d, element); },
          onmouseover: function (d) { console.log("onmouseover", d); },
          onmouseout: function (d) { console.log("onmouseout", d); }
        },
        axis: {
          x: {
            type: 'categorized',
            
          }
        },
        bar: {
          width: {
            ratio: 0.3,
//            max: 30
          },
        }
      });
            } 
        }
        xmlhttp.open("GET", "mapquery?dep=" + dep + "&yr=" + yr , true);
        xmlhttp.send();
       
   }
   function bud(){
	var yr = document.getElementById('year').innerHTML;
        var dep = document.getElementById('yr').value;
        var typ = document.getElementById('typ').value;
       // alert(type);
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
          
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                object = JSON.parse(xmlhttp.responseText);
            //  alert(object.Expenditure);
               var chart = c3.generate({
        data: {
            x:'x',
          columns: object,
    
          type: 'bar',
          
          onclick: function (d, element) { console.log("onclick", d, element); },
          onmouseover: function (d) { console.log("onmouseover", d); },
          onmouseout: function (d) { console.log("onmouseout", d); },
          types: {
              Average : 'spline',
          }
        },
        
        axis: {
          x: {
            type: 'categorized',
            
          }
        },
        bar: {
          width: {
            ratio: 0.3,
//            max: 30
          },
        }
      });
            } 
        }
        xmlhttp.open("GET", "mapbhquery?dep=" + dep + "&typ=" + typ + "&yr=" + yr, true);
        xmlhttp.send();
       
   }
        
      
    </script>
