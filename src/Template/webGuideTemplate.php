<?php
echo <<<WGT
<article id="{$href}" class="d-flex flex-column">
    <header class="flex-row my-4">
                <h1 class="name">{$name} </h1>
                <hr class="pencil">
    </header>
    <section class="d-flex flex-row mb-5 py-5 justify-content-center">
        <div clas="d-flex flex-column">
WGT;
        if(!empty($guides)) {
            foreach($guides as $guide){
                echo '<p><a href="'."{$guide->getURL()}".'"'.">{$guide->getDescription()}</a></p>";
            }
        }
        else echo'<p>No hay guias activas</p>';
echo "</div>
</section>
</article>";
