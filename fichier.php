<?php
require 'includes/init.php';



if (isset($_GET['idEvent'])) {
    $id=$_GET['idEvent'];
    
    $event=$event_obj->listEvent($_GET['idEvent']);
    
    $json=json_encode($event);
    echo $json;
}else{
            require 'event.php';
        }

?>