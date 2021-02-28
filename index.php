<?php
//development only variables!!!
error_reporting( E_ALL);
ini_set("display_errors",1);
//echo "GET:";
//var_dump($_GET);
//echo "POST:";
//var_dump($_POST);
// DELETE ABOVE BEFORE GOING LIVE
include_once "controller/main_controller.php";

/*
Things that need doing:
Update backend so tutor name is associated with turials
Update Student and Teacher views first select teacher then tutorials (only generate list of existing tutorials)
Finish front end presentation
Refactor to avoid redundancy
Verify file lock is working properly
*/
