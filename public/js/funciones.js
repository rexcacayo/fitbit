$(document).ready(function(){
    $('#agregarAttr').click(function(){
        var inicioF = '<div class="atributes">'
        var object = '<strong>Letra:</strong><input type="text" name="attrObject[]" class="form-control tamaño1" required>';
        var name =  '<strong>Nombre:</strong><input type="text" name="attrName[]" class="form-control tamaño2" required>';
        var type =  '<strong>Tipo:</strong><select name="attrType[]" class="form-control"><option value="Float">Float</option><option value="Integer">Integer</option><option value="String">String</option></select>';
        var deleted = '<button type="button" class="btn btn-danger quitar" onClick="eliminarElemento(this);">X</button>'
        var finF = '</div>';
        $('#attr').append(inicioF+object+name+type+deleted+finF);
        $(".quitar").each(function(index) {
            $(this).attr("id", this.id + index);
        });
        $(".atributes").each(function(index) {
            $(this).attr("id", this.id + index);
        });


    })
})


function eliminarElemento(elemento){
    var id = elemento.id;
    imagen = document.getElementById(id);
	padre = imagen.parentNode;
	padre.removeChild(imagen);
}
