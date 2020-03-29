<?php 
echo <<<TIL
    <div class="page-scroll tile">
        <a href="{$href}" class="rounded">
            <img class="tileimage mx-auto d-block" src="{$thumbnail}" alt="imagen de {$name}">
            <span class="tilebadge text-center name d-block rounded-bottom">{$name}</span>
        </a>
    </div>
TIL;
