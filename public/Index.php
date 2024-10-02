<?php

namespace public;

spl_autoload_register(function ($className) {
    $loadClass = '../' . str_replace('\\', '/', $className) . '.php';
    require_once $loadClass;
});
