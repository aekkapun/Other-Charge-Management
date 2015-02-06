<?php 
$this->title = 'Master Report';
if(Yii::$app->user->can("admin")){
    
}
else{
$id = Yii::$app->user->identity->id;
}
?>
<div style="display: none" id="depid"><?php echo $id; ?></div>
<div style="background-color: #E6C884; margin: 20px; padding: 15px" >
    <form role="form" >
    <div class="col-md-12" style="margin-top: 30px;">
    <div class="col-md-2 col-md-offset-5 form-group">
    
      <select class="form-control" id="yr" >
          <option value="" id="">Select Year</option>
          <?php 
            $rown =(new \yii\db\Query())
                ->select('*')
                ->from('financial_year_tbl')
                ->where(['dep_id'=> $id])
                ->all();   
                foreach ($rown as $i=>$row){?>
                 
                     <option value="<?php echo $row['year']?>" id="yr<?php echo $row['year']?>">
                     <?php echo $row['year'] ?>
                     
                     </option>
               <?php }  ?>
           
      </select>
      
    </div>
    </div>
  </form>

<div class="col-md-12">
<form>
    <div class="col-md-3">         
        <div style="text-align: center;"> Expenditure  <br>
        <input type="checkbox" id="exp" onchange=eshow() />
        </div>
        <div id="exp-ch" >
            
            
            <input type="checkbox" id="e0" />&nbsp;Bill Date<br>
           <input type="checkbox" id="e1" />&nbsp;Bill No<br>
            <input type="checkbox" id="e2" />&nbsp;Bill Diary No<br>
            <input type="checkbox" id="e3" />&nbsp;Bill Amount<br>
            <input type="checkbox" id="e4" />&nbsp;Payment Information<br>
            <input type="checkbox" id="e5" />&nbsp;Description<br>
            <input type="checkbox" id="e6" />&nbsp;Status<br>
            <input type="checkbox" id="e7" />&nbsp;Remark<br>

        </div>
    </div>
    
    <div class="col-md-3">         
        <div style="text-align: center;"> OCR  <br>
        <input type="checkbox" id="ocr" onchange=oshow() />
        </div>
        <div id="ocr-ch" >
            <input type="checkbox" id="o0" />&nbsp;Opening Amount<br>
            <input type="checkbox" id="o1" />&nbsp;Total Expenditure<br>
           <input type="checkbox" id="o2" />&nbsp;Available Balance<br>
           

        </div>
    </div>
    <div class="col-md-3">         
        <div style="text-align: center;"> BHS  <br>
        <input type="checkbox" id="bhs" onchange=bshow() />
        </div>
        <div id="bhs-ch" >
            <input type="checkbox" id="b0" />&nbsp;Amount<br>
            <input type="checkbox" id="b1" />&nbsp;Expenditure<br>
           <input type="checkbox" id="b2" />&nbsp;Balance<br>   
        </div>
    </div>
    <div class="col-md-3">         
        <div style="text-align: center;"> Advance  <br>
        <input type="checkbox" id="adv" onchange=ashow() />
        </div>
        <div id="adv-ch" >
            <input type="checkbox" id="a0" />&nbsp;Entry No<br>
            <input type="checkbox" id="a1" />&nbsp;Budget Head<br>
           <input type="checkbox" id="a2" />&nbsp;Amount<br> 
           <input type="checkbox" id="a3" />&nbsp;Drawn On<br>
            <input type="checkbox" id="a4" />&nbsp;Settled On<br>
           <input type="checkbox" id="a5" />&nbsp;Status<br> 
           <input type="checkbox" id="a6" />&nbsp; Advance Status<br> 
        </div>
      
    </div>
    
</form>
</div><br>
<div class="col-md-offset-6" style="margin-top:30px;">
<button class="btn btn-success" onclick="master()">Submit</button>
</div>
</div>
<div id="mtable"></div>
<?php 
?>
<div id="printbtn" >
    
    <div class="col-md-12">
        <div class="col-md-12">
            <form>
        
                <div style="margin:1px;" class="col-md-3"><input class="form-control" type="text" value="" placeholder="Header Left" id="hl" /></div>
                <div style="margin:1px;"  class="col-md-3"><input class="form-control" type="text" value="" placeholder="Header Center" id="hc" /></div>
                <div style="margin:1px;"  class="col-md-3"><input class="form-control" type="text" value="" placeholder="Header Right" id="hr" /></div>
                <div style="margin:1px;"  class="col-md-3"><input class="form-control" type="text" value="" placeholder="Footer Left" id="fl" /></div>

                <div style="margin:1px;"  class="col-md-3"><input class="form-control" type="text" value="" placeholder="Footer Right" id="fr" /></div>

            </form>
        </div>
       
        <div class="col-md-offset-6" >        
        <a onclick="pdfmaster()" target="_blank"><button style="margin-top:10px;" class="btn btn-success">Print</button></a>
        </div> 
    </div>
</div>
<script type="text/javascript">
    function pdfmaster(){
        var hl = document.getElementById("hl").value;
        var hc = document.getElementById("hc").value;
        var hr = document.getElementById("hr").value;
        var fl = document.getElementById("fl").value;
      
        var fr = document.getElementById("fr").value;
        var depid = document.getElementById("depid").innerHTML;
        var yr = document.getElementById("yr").value;
        var print=0;if($('#pri').is(':checked')){ print=1;}
        var ex=0;if($('#exp').is(':checked')){ ex=1;}
        var ex0=0;if($('#e0').is(':checked')){ ex0=1;}
        var ex1=0;if($('#e1').is(':checked')){ ex1=1;}
        var ex2=0;if($('#e2').is(':checked')){ ex2=1;}
        var ex3=0;if($('#e3').is(':checked')){ ex3=1;}
        var ex4=0;if($('#e4').is(':checked')){ ex4=1;}
        var ex5=0;if($('#e5').is(':checked')){ ex5=1;}
        var ex6=0;if($('#e6').is(':checked')){ ex6=1;}
        var ex7=0; if($('#e7').is(':checked')){ ex7=1;}
         
        var oc=0;if($('#ocr').is(':checked')){ oc=1;}
        var oc0=0;if($('#o0').is(':checked')){ oc0=1;}
        var oc1=0;if($('#o1').is(':checked')){ oc1=1;}
        var oc2=0;if($('#o2').is(':checked')){ oc2=1;}
       
        var bh=0;if($('#bhs').is(':checked')){ bh=1;}
        var bh0=0;if($('#b0').is(':checked')){ bh0=1;}
        var bh1=0;if($('#b1').is(':checked')){ bh1=1;}
        var bh2=0;if($('#b2').is(':checked')){ bh2=1;}
        
        var ad =0;if($('#adv').is(':checked')){ ad=1;}
        var ad0 =0;if($('#a0').is(':checked')){ ad0=1;}
        var ad1 =0;if($('#a1').is(':checked')){ ad1=1;}
        var ad2 =0;if($('#a2').is(':checked')){ ad2=1;}
        var ad3 =0;if($('#a3').is(':checked')){ ad3=1;}
        var ad4 =0;if($('#a4').is(':checked')){ ad4=1;}
        var ad5 =0;if($('#a5').is(':checked')){ ad5=1;}
        var ad6 =0;if($('#a6').is(':checked')){ ad6=1;}
      window.open("master-reportpdf?hl="+hl +"&hc="+hc +"&hr="+hr +"&fl="+fl +"&fr="+fr +"&depid="+depid+"&year="+yr+"&ex=" +ex + "," +"&ex0=" +ex0 +"&ex1=" +ex1 +
             "&ex2=" +ex2 +"&ex3=" +ex3 +"&ex4=" +ex4 +"&ex5=" +ex5 +"&ex6=" +ex6 +"&ex7=" +ex7 +"&oc="+oc + 
         "&oc0="+oc0 +"&oc1="+oc1 +"&oc2="+oc2 +"&bh="+bh +"&bh0="+bh0 +"&bh1="+bh1 +"&bh2="+bh2 +  "&ad="+ad  + 
         "&ad0="+ad0 +"&ad1="+ad1 +"&ad2="+ad2 +"&ad3="+ad3  +"&ad4="+ad4  + "&ad5="+ad5 + "&ad6="+ad6);
        
    }
    function master(){ 
       
        var depid = document.getElementById("depid").innerHTML;
        var yr = document.getElementById("yr").value;
        var print=0;if($('#pri').is(':checked')){ print=1;}
        var ex=0;if($('#exp').is(':checked')){ ex=1;}
        var ex0=0;if($('#e0').is(':checked')){ ex0=1;}
        var ex1=0;if($('#e1').is(':checked')){ ex1=1;}
        var ex2=0;if($('#e2').is(':checked')){ ex2=1;}
        var ex3=0;if($('#e3').is(':checked')){ ex3=1;}
        var ex4=0;if($('#e4').is(':checked')){ ex4=1;}
        var ex5=0;if($('#e5').is(':checked')){ ex5=1;}
        var ex6=0;if($('#e6').is(':checked')){ ex6=1;}
        var ex7=0; if($('#e7').is(':checked')){ ex7=1;}
         
        var oc=0;if($('#ocr').is(':checked')){ oc=1;}
        var oc0=0;if($('#o0').is(':checked')){ oc0=1;}
        var oc1=0;if($('#o1').is(':checked')){ oc1=1;}
        var oc2=0;if($('#o2').is(':checked')){ oc2=1;}
       
        var bh=0;if($('#bhs').is(':checked')){ bh=1;}
        var bh0=0;if($('#b0').is(':checked')){ bh0=1;}
        var bh1=0;if($('#b1').is(':checked')){ bh1=1;}
        var bh2=0;if($('#b2').is(':checked')){ bh2=1;}
        
        var ad =0;if($('#adv').is(':checked')){ ad=1;}
        var ad0 =0;if($('#a0').is(':checked')){ ad0=1;}
        var ad1 =0;if($('#a1').is(':checked')){ ad1=1;}
        var ad2 =0;if($('#a2').is(':checked')){ ad2=1;}
        var ad3 =0;if($('#a3').is(':checked')){ ad3=1;}
        var ad4 =0;if($('#a4').is(':checked')){ ad4=1;}
        var ad5 =0;if($('#a5').is(':checked')){ ad5=1;}
        var ad6 =0;if($('#a6').is(':checked')){ ad6=1;}
     alert(ad6);
    if(yr){
         }
        else{
            alert("Year is not selected");
        }
    

     
 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("mtable").innerHTML = xmlhttp.responseText;
                $('#printbtn').show();
            }
        }
        xmlhttp.open("GET",
        "mt?print="+print+"&depid="+depid+
            "&year="+yr+
    "&ex=" +ex + "," +
         "&ex0=" +ex0 + 
         "&ex1=" +ex1 + 
         "&ex2=" +ex2 + 
        "&ex3=" +ex3 + 
         "&ex4=" +ex4 + 
         "&ex5=" +ex5 + 
         "&ex6=" +ex6 + 
         "&ex7=" +ex7 + 
         
         "&oc="+oc + 
         "&oc0="+oc0 + 
         "&oc1="+oc1 + 
         "&oc2="+oc2 + 
       
         "&bh="+bh + 
         "&bh0="+bh0 + 
         "&bh1="+bh1 + 
         "&bh2="+bh2 + 
        
         "&ad="+ad  + 
         "&ad0="+ad0 + 
         "&ad1="+ad1 +  
         "&ad2="+ad2 +  
         "&ad3="+ad3  + 
         "&ad4="+ad4  + 
         "&ad5="+ad5 +
         "&ad6="+ad6,
        true);
        xmlhttp.send();
    
    }
    
    function eshow(){   
    if($('#exp').is(':checked'))
        {
            $('#exp-ch').show(); 
        }
        else{            
            $('#exp-ch').hide();
        }
    }
    function oshow(){   
    if($('#ocr').is(':checked'))
        {
            $('#ocr-ch').show(); 
        }
        else{            
            $('#ocr-ch').hide();
        }
    }
    function bshow(){   
    if($('#bhs').is(':checked'))
        {
            $('#bhs-ch').show(); 
        }
        else{            
            $('#bhs-ch').hide();
        }
    }
    function ashow(){   
    if($('#adv').is(':checked'))
        {
            $('#adv-ch').show(); 
        }
        else{            
            $('#adv-ch').hide();
        }
    }
</script>