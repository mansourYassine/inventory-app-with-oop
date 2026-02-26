<?php

declare(strict_types=1);

function dd($element) {
    echo "<pre>";
    var_dump($element);
    echo "</pre>";
    die();
}

function dump($element) {
    echo "<pre>";
    var_dump($element);
    echo "</pre>";
}