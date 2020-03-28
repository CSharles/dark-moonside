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
        $( "#co-id" ).val( $( td[2] ).text() );
    });
    $( "#editar-enlace" ).click(function(){
        var td=editSetup();
        $( "#link-description" ).val( $( td[0] ).text() );
        $( "#link-url" ).val( $( td[1] ).text() );
        $( "#mod-id" ).val( $( td[2] ).text() );
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
        var btn=$( ".add-update").text("Actualizar");
        btn.removeClass("btn-primary");
        btn.addClass("btn-warning");
        return td;
    }
});

//vista previa de imagen
var input = document.querySelector('input');
var preview = document.querySelector('.preview');
var imagePlace= document.querySelector('.figure-img');
input.addEventListener('change', updateImageDisplay);
function updateImageDisplay() {
  var curFile = input.files;
  if(curFile.length === 0) {
    var message = document.createElement('p');
    message.textContent = 'No files currently selected for upload';
    preview.appendChild(message);
  } else {
      var message = document.createElement('p');
      if(validFileType(curFile[0])) {
        imagePlace.src = window.URL.createObjectURL(curFile[0]);
      } else {
        message.textContent = 'File name ' + curFile[0].name + ': Not a valid file type. Update your selection.';
            preview.appendChild(message);
      }
  }
}
function validFileType(file) {
    if(file.type.match(/^image\//)) {
      return true;
    }
  return false;
}
