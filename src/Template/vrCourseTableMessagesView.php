<p class="alert alert-danger inline" role="alert">
                    <strong>Error: </strong>
                    <?php 
                        if($errorCode=="23505"){
                            echo "Ya existe este Curso";
                        } else{
                            echo $errorMessage;
                        }?>
                </p>