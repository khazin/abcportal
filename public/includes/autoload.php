<?php
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . "/students/sg0318a11/abcportal/" .$class_name . '.php';
});
?>
