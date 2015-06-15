/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */
function Programas(){
    
    
}

Programas.prototype.procesoEnviaForm = function(classFrm,url,btn,urlCarga){
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
                               $("#ML_divPopup").html('<div class="alert alert-dismissable alert-success"><strong>Terminado</strong><br/> Proceso realizado con &eacute;xito.</div>');
                            }
                 }                 
             }
         });
         return false;      
     }   


Programas.prototype.abrePopupCenter = function(docPHP, titulo, cod){
    $("#ML_divPopup").html('');
    $("#ML_tituloForm").html(titulo);
    $.post(docPHP, 
    {
        post_open: 'on',
        post_cod: cod
    }, function(data)
    {
        $("#ML_divPopup").html(data);
    });
}

Programas.prototype.procesoAddCarro = function(classFrm,url,btn){
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
                 
                 if(!data){
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
                            
                                exito();
                                //$("#ML_divPopup").html('<div class="alert alert-dismissable alert-success"><strong>Agregado al Carro</strong><br/> Proceso realizado con &eacute;xito.</div>');
                                $('.badge').html(data);
                                
                            
                 }                 
             }
         });
         return false;      
}





