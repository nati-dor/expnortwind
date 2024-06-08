<?php
function autoload_nortwind($name) {
    $filename = "inc/$name.class.php";
    if(file_exists($filename))
        require_once $filename;
    else if(file_exists("../".$filename))
        require_once "../".$filename;
    else if(file_exists("../../".$filename))
        require_once "../../".$filename;
}
spl_autoload_register('autoload_nortwind');
