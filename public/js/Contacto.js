/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

//Clase contacto
function Contacto(){
    
    
}

Contacto.prototype.procesoEnviaForm = function(classFrm,url,btn,urlCarga){
$("#" + btn).attr('disabled', 'disabled');
        initLoad();
      var formData = new FormData($("." + classFrm)[0]);
     
        $.ajax({
             type:"POST", 
             url:url,
             data:formData,
             cache: false,
             contentType: false,
             processData: false,
             beforeSend: function () {
             },
             success:function(data)
             {    
                 endLoad();
                 
                 if(data !== 'OK'){
                    //$("#msjWar").html(data);
                    noExito(data);
                    $("#" + btn).delay(2000).queue(function (m)
                            {
                                $("#" + btn).removeAttr("disabled");
                                m();
                            });
                 }  
                 else{
                               
                            $("#" + btn).delay(2000).queue(function (m)
                            {
                                $("#" + btn).removeAttr("disabled");
                                m();
                            });
                            
                            if(urlCarga !== ''){
                                $("#ML_divPopup").html('<div class="alert alert-dismissable alert-success"><strong>Terminado</strong><br/> Proceso realizado con &eacute;xito.</div>');
                                setTimeout("location.href = '"+urlCarga+"'", 2000);
                            }
                            else{
                               exito(); 
                            }
                 }                 
             }
         });
         return false;      
    
}


