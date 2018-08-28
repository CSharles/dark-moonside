function setSelection(row){
    if ($(row).hasClass("selected")){
        $(row).removeClass("selected");
    }else{

        $(row).addClass("selected").siblings().removeClass("selected");
    }
}
$(document).ready(function() {
    $('#editarCurso').click(function () {
        var td = $( ".selected" ).children();
        $( "h4[data-id='modaltitle']" ).text( "Editar curso" );
        var btn=$( "#add-update").text("Actualizar");
        btn.removeClass("btn-primary");
        btn.addClass("btn-warning");
        $( "#course-name" ).val( $( td[0] ).text() );
        $( "#course-id" ).val( $( td[1] ).text() );
    })
    $('#editarModulo').click(function () {
        var td = $( ".selected" ).children();
        $( "h4[data-id='modaltitle']" ).text( "Editar modulo" );
        var btn=$( "#add-update").text("Actualizar");
        btn.removeClass("btn-primary");
        btn.addClass("btn-warning");
        $( "#module-name" ).val( $( td[0] ).text() );
        $( "#module-id" ).val( $( td[1] ).text() );
        $( "#course-id" ).val( $( td[2] ).text() );
    })
    $( "#eliminarCurso" ).click(function(){
        var td = $( ".selected" ).children();
        $( "#deleteForm" ).children( "input" ).val( $( td[1] ).text() );
        $( "#deleteForm" ).submit();
    });
    $( "#eliminar-modulo" ).click(function(){
        var td = $( ".selected" ).children();
        $( "#deleteModuleForm" ).children( "input" ).val( $( td[1] ).text() );
        $( "#deleteModuleForm" ).submit();
    });
    $( "#eliminarEnlace" ).click(function(){
        var td = $( ".selected" ).children();
        $( "#deleteLinkForm" ).children( "input" ).val( $( td[1] ).text() );
        $( "#deleteLinkForm" ).submit();
    });
});
