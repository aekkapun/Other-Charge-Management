

$(document).ready(function(){
       
         var oTable = $("#table_id").dataTable();
         var aTrs = oTable.fnGetNodes(); 
       	       $("#ch0").click(function(){
                   //$("#uncheck").prop('checked', false);  
                   var mail_id    = new Array(); 
                  // var no_of_rows = (document.querySelectorAll("input[type=checkbox]").length)-2;
                   for(i=0; i < aTrs.length; i++){ 
        	              	     if($("#ch"+i).is(':checked')){      
                             var Data   = oTable.fnGetData(i);
                             mail_id[i] = Data[7]; 
                            }
                    } 
                    // $("#mail_id").val(mail_id);
                     if($('[type="checkbox"]:checked').length < 1)
                                 alert("select checkbox for sending mail");
                                 else{
                                       $.fancybox.showLoading();
                                       $.ajax({
                                                 type  : "POST",
                                                 cache : false,
                                                 //url   : "mail.php?mail_id="+mail_id,
                                                 data  : mail_id,
                                                 
                                                 success : function(data) 
                                                 {
                                                     $.fancybox(data, { fitToView: false,
                                                                        width: 905,
                                                                        height: 505,
                                                                        autoSize: false,
                                                                        closeClick: false,
                                                                        openEffect: 'none',
                                                                        closeEffect: 'none'
                                                                      }
                                                               );
                                                 }
                                              });
                                     }
      
               });
               
               
              
  });