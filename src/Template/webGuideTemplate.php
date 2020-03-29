<?php
echo <<<WGT
<article id="{$href}" class="d-flex flex-column">
    <header class="flex-row">
                <h1 class="name">{$name} </h1>
                <hr class="pencil">
    </header>
    <section class="d-flex flex-row justify-content-center">
WGT;
        if(!empty($guides)) {
            foreach($guides as $guide){
                echo '<p><a href="'."{$guide->getURL()}".'"'.">{$guide->getDescription()}</a></p>";
            }
        }
        else echo'<p>No hay guias activas</p>';
echo "</section>
</article>";
