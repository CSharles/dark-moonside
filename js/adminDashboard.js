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
    $( "#eliminarCurso" ).click(function(){
        var td = $( ".selected" ).children();
        $( "#deleteForm" ).children( "input" ).val( $( td[1] ).text() );
        var dd= $( "#deleteForm" ).children( "input" );
        $( dd ).val( $( td[1] ).text() );
        $( "#deleteForm" ).submit();
    });
});
