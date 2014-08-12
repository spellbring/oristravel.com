/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

$(document).ready(function(){
    var getCiudades = function()
    {
        $.post('/oristravel.com/ajax/getCiudades', 'pais=' + $('#pais').val(), function(datos){
            $('#ciudad').html('');
        }, 'json');
    }
});
