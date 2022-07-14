<?php

function inc(string $component): void
{
    require_once __DIR__ . "/View/inc/$component.php";
}
