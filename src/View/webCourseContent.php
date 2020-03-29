
<?php 
$exams = $this->getExams();
$modules= $this->getModules();
$name= $this->course->getName();
?>
<main>
    <section id="controls" class="container-fluid">
        <header class="row">
            <div class="col-2 d-none d-sm-block">
                <img class="img-fluid d-block mx-auto w-50" src="../img/profile.png" alt="imagen estudiante">
            </div>
            <h1 class="name mx-auto ml-sm-0"><?php echo $name;?></h1>
        </header>
        <article class="d-flex flex-wrap align-items-center justify-content-center">
            <?php foreach ($controls as $control){ 
                    $thumbnail=isset($control['thumbnail'])?$control['thumbnail']:"../img/profile.png";
                    $href=$control['id'];
                    $name=$control['name'];
                    include __DIR__."/../Template/webTileTemplate.php";
                }?>
        </article>            
    </section>
    <section class="d-flex flex-column" id="exams">
        <header class="flex-row">
                <h1 class="name">Examenes Activos</h1>
                <hr class="star-light">
        </header>
        <article class="d-flex flex-column align-items-center">
            <?php
                if(!empty($exams)) {
                    foreach($exams as $exam){
                        echo '<p><a href="'."{$exam->getURL()}".'"'.">{$exam->getDescription()}</a></p>";
                    }
                }
                else echo'<p>No hay examens activos</p>';
            ?>
        </article>
    </section>
    <section class="container-fluid success" id="modules">
        <article class="d-flex flex-wrap align-items-center justify-content-center">
            <?php //Create the tiles for each module
                if (is_array($modules) && !empty($modules)) {
                    foreach ($modules as $module){ 
                        $thumbnail=isset($control['thumbnail'])?$control['thumbnail']:"../img/profile.png";
                        $href="#".$module->getModuleID();
                        $name=$module->getName();
                        include __DIR__."/../Template/webTileTemplate.php";
                    }
                }
                else echo'<p>No hay modulos activos</p>';
            ?>
        </article> 
        <?php // An Article element containing the guides for each module
            if (is_array($modules) && ! empty($modules)) {
                foreach ($modules as $module){ 
                    $href=$module->getModuleID();
                    $name=$module->getName();
                    $guides=$module->getGuides();
                    include __DIR__."/../Template/webGuideTemplate.php";
                }
            }
            else echo'<p>No hay guias para este modulo</p>';
        ?>
    </section> 
    <aside>
        <section class="d-flex flex-column" id="resources">
            <header class="flex-row">
                <h1 class="name">Recursos para prácticas</h1>
                <hr class="star-light">
            </header>
            <article class="d-flex flex-column align-items-center">
                <p><a href="triptico2.rar" download>Recursos para Triptico #2</a></p>
            </article>
        </section>
        <section class="d-flex flex-column" id="misc">
            <header class="flex-row">
                <h1 class="name">Miscelaneas</h1>
                <hr class="star-light">
            </header>
            <article class="d-flex flex-column align-items-center">
                <p>No hay miscelaneas</p>
            </article>
        </section>
    </aside>
</main>