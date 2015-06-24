/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */
//Clase contacto
function Hoteles(){
    
    
}

Hoteles.prototype.procesoEnviaForm = function(classFrm,url,btn,urlCarga){
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


Hoteles.prototype.abrePopupCenter = function(docPHP, titulo, cod){
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

Hoteles.prototype.verMapa = function(url, mapa){

    $.post(url, 
    {
        post_open: 'on' 
    }, function(data)
    {
        $("#"+mapa).html(data);
    });
}

Hoteles.prototype.procesoAddCarro = function(classFrm,url,btn){
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


Hoteles.prototype.abrePopupFoto = function(docPHP, titulo, imgenc, img1, img2, img3, img4){
    $("#ML_divPopup").html('');
    $("#ML_tituloForm").html(titulo);
    $.post(docPHP, 
    {
        post_open: 'on',
        post_img_enc: imgenc,
        post_img1: img1,
        post_img2: img2,
        post_img3: img3,
        post_img4: img4
    }, function(data)
    {
        $("#ML_divPopup").html(data);
    });
}


