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
    $( "#course-name" ).val( $( td[0] ).text() );
    $( "#course-id" ).val( $( td[1] ).text() );
})});