<?php
//Set globally used variables
$title = "Tutorial Scheduling Made Easy";
$message;
$body=[];
//instantiate new class for the xml handler
include_once "model/xml_class.php";
$schedule = new xml_handler;
//Instantiates a new class for handling input safety
include_once "model/input_helper.php";
$inputHandler = new input_helper;
//This will purge old xml files (old tutorials
$schedule->clear_old();
//
if (isset($_POST['addMe'])) {
  //Eventually need to sainitize time input as well
    $time = $_POST['time'];
    //
    $name = $inputHandler->cleanInputToLower($_POST['myName']);
    $entry = $inputHandler->cleanInputNoSpaceToLower($_POST['entry']);
  if (strlen($name) < 31 && strlen($name) > 5) {
    $message = $schedule->addName($time,$name,$entry);
  } else {
    $message = "Your name needs to be more than 5 characters and no more than 30";
  }

}


//Load Views

include_once "view/all/header.php";
if (isset($_GET['v'])) {
  $view = $inputHandler->cleanInputNoSpace($_GET['v']);
  if (file_exists("view/".$view.".php")) {
    $id = $inputHandler->cleanInputNoSpace($_GET['id']);
    if ($_GET['v'] == "tutorial" && isset($_GET['id'])) {
      $body = $schedule->get_tutorial_details($id);
    }
    include_once "view/".$view.".php";
  } else {
    $body = $schedule->get_all_xml_files();
  include_once "view/allTutorials.php";
}
} else {
  $body = $schedule->get_all_xml_files();
  include_once "view/allTutorials.php";

}
include_once "view/all/footer.php";
