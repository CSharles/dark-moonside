function setSelection(row){
    if ($(row).hasClass("selected")){
        $(row).removeClass("selected");
    }else{

        $(row).addClass("selected").siblings().removeClass("selected");
    }
}
$(document).ready(function() {
    $('#editar-curso').click(function () {
        var td=editSetup();
        $( "#course-name" ).val( $( td[0] ).text() );
        $( "#course-id" ).val( $( td[1] ).text() );
    });
    $('#editar-modulo').click(function () {
        var td=editSetup();
        $( "#module-name" ).val( $( td[0] ).text() );
        $( "#module-id" ).val( $( td[1] ).text() );
        $( "#course-id" ).val( $( td[2] ).text() );
    });
    $( "#editar-enlace" ).click(function(){
        var td=editSetup();
        $( "#link-description" ).val( $( td[0] ).text() );
        $( "#link-url" ).val( $( td[1] ).text() );
        $( "#module-id" ).val( $( td[2] ).text() );
    });
    $( "#eliminar-curso" ).click(function(){
        var td = $( ".selected" ).children();
        $( "#deleteForm" ).children( "input" ).val( $( td[1] ).text() );
        $( "#deleteForm" ).submit();
    });
    $( "#eliminar-modulo" ).click(function(){
        var td = $( ".selected" ).children();
        $( "#deleteModuleForm" ).children( "input" ).val( $( td[1] ).text() );
        $( "#deleteModuleForm" ).submit();
    });
    $( "#eliminar-enlace" ).click(function(){
        var td = $( ".selected" ).children();
        $( "#deleteLinkForm" ).children( "input" ).val( $( td[1] ).text() );
        $( "#deleteLinkForm" ).submit();
    });
    function editSetup(){
        var td = $( ".selected" ).children();
        $( "h4[data-id='modaltitle']" ).text( "Editar" );
        var btn=$( "#add-update").text("Actualizar");
        btn.removeClass("btn-primary");
        btn.addClass("btn-warning");
        return td;
    }
});
