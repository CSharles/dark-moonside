<?php $coursesList = $this->getCoursesList();?>
    <main class="container-fluid">
        <section id="courses">
            <header class="row">
                <div class="col-2 d-none d-sm-block">
                    <img class="img-fluid d-block mx-auto w-50" src="../img/profile.png" alt="imagen estudiante">
                </div>
                <h1 class="name  mx-auto ml-sm-0">Aula Virtual</h1>
            </header>
            <article class="d-flex flex-wrap align-items-start justify-content-around">
                <?php foreach ($coursesList as $course){ 
                    $thumbnail=isset($course['thumbnail'])?$course['thumbnail']:"../img/profile.png";
                    $href="?id=".$course['CourseID'];
                    $name=$course['Name'];
                    include __DIR__."/../../src/Template/webCardTemplate.html";
                }?>
            </article>            
        </section>
    </main>