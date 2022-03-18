<?php
session_start();
session_regenerate_id(true);

require 'classes/Database.php';
require 'classes/User.php';
require 'classes/Evenements.php';
require 'classes/Admin.php';
require 'classes/newsLetter.php';
require 'classes/comment.php';


// DATABASE CONNECTIONS
$db_obj = new Database();
$db_connection = $db_obj->dbConnection();

//ADMIN OBJECT
$admin_obj= new Admin($db_connection);

// USER OBJECT
$user_obj = new User($db_connection);

//event object
$event_obj =  new Evenements($db_connection);

//newsletter
$newsLetter_obj = new newsLetter($db_connection);

//comment
$comment_obj =  new  comment($db_connection);
?>