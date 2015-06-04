/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

function Carro(){
    
}

Carro.prototype.abrePopupCenter = function(docPHP, titulo, cod, cont, codProg, codServ){
    $("#ML_divPopup").html('');
    $("#ML_tituloForm").html(titulo);
    $.post(docPHP, 
    {
        post_open: 'on',
        post_cod: cod,
        post_cont:cont,
        post_codProg: codProg,
        post_serv: codServ
    }, function(data)
    {
        $("#ML_divPopup").html(data);
    });
}

 Carro.prototype.abreEliminaCarro = function(docPHP, titulo, cod, urlCarga)
{
    $("#ML_divPopup").html('');
    $("#ML_tituloForm").html(titulo);
    $.post(docPHP, 
    {
        post_open: 'on',
        post_cod: cod
    }, function(data)
    {
        //alert(data);
       $("#ML_divPopup").html('<div class="alert alert-dismissable alert-success"><strong>Terminado</strong><br/> Proceso realizado con &eacute;xito.</div>');
        setTimeout("location.href = '"+urlCarga+"'", 2000);
    });
}



