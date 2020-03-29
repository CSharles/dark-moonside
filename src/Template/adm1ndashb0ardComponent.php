<main class="col-md">
    <section id="content" class="row">
        <article class="column">
                        <header class="ml-3 column">
                            <?php 
                                    $ComponentName=$componentHeaders["Name"];
                                    $ComponentSubHeader=$componentHeaders["SubHeader"];
                                    $ComponentDescription=$componentHeaders["Description"];
                            print(
                                "<h1>{$ComponentName}</h1>
                                <h2>{$ComponentSubHeader}</h2>
                                <p>{$ComponentDescription}</p>");?>
                        </header>
                        <div class="row">
                            <div id="data" class="table-wrapper ml-3">
                                <?=$buferedTable?>
                            </div>
                            <aside class="controls">
                                <button type="button" class="btn btn-primary" 
                                data-toggle="modal" data-target="<?php echo $componentControls["Target"]; ?>">Nuevo</button>
                                <button type="button" class="btn btn-info" id="<?php echo $componentControls["EditId"]; ?>" 
                                data-toggle="modal" data-target="<?php echo $componentControls["Target"]; ?>">Editar</button>
                                <button type="button" class="btn btn-danger" id="<?php echo $componentControls["DeleteId"]; ?>">Eliminar</button>
                                <form action="" method="post" id="<?php echo $componentControls["FormId"]; ?>" class="d-none">
                                    <input name="<?php echo $componentControls["DeleteElement"]; ?>" type="text" value='' />
                                </form>
                            </aside>
                        </div>
                        <!--Modal-->
                        <?php include __DIR__.$componentModal["view"]; ?>

        </article>
    </section>
</main>
    </div><!--row--> 
    </div><!--container--> 
