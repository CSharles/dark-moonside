<!-- The Modal -->
<div class="modal fade" id="<?php echo $componentModal["ModalId"];?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 data-id="modaltitle" class="modal-title"><?php echo $componentModal["ModalTitle"];?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="course-name">Nombre del curso</label>
                        <input name="courseName" id="course-name" value="" placeholder="Nombre del curso" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="course-id">Id del curso</label>
                            <input name="courseId" id="course-id" value="" placeholder="Id del curso" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="course-thumb">Miniatura</label>
                            <input name="courseThumb" id="course-thumb" value="" placeholder="Imagen del curso" type="file" class="form-control-file">
                            <img  id="preview" src="" alt="preview of image" class="rounded img-thumbnail img-fluid">
                    </div>
                    <div class="form-group d-flex">
                        <span class="mr-3 switch-label">Activo</span>
                        <label class="switch">
                            <input class="form-check-input" type="checkbox" name="isActive" id="isActiveCheck" value="1" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <button name="sender" type="submit" class="add-update btn btn-primary" 
                    value="<?php echo $componentModal["ModalButton"];?>">Agregar</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            
        </div>
    </div>
</div> 




