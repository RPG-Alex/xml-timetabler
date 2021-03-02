<?php
//Set globally used variables
$title = "Tutorial Scheduling Made Easy";
$message;
$body= null;
$header = "view/all/header.php";
$footer = "view/all/footer.php";
$view = "view/allTutorials.php";
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
if (isset($_GET['v'])) {
  $page = $inputHandler->cleanInputNoSpace($_GET['v']);
  if (file_exists("view/".$page.".php")) {
    if ($_GET['v'] == "tutorial" && isset($_GET['id'])) {
      $id = $inputHandler->cleanInputNoSpace($_GET['id']);
      $body = $schedule->get_tutorial_details($id);
    } elseif ($_GET['v'] == "teacherAllTutorials" && isset($_GET['teacher']) && strlen($_GET['teacher']) > 0) {
      $tutor = $inputHandler->cleanInputPeriodsNoSpaces($_GET['teacher']);
      $body = $schedule->get_all_xml_files_for_tutor($tutor);
    }
    $view = "view/".$page.".php";
  } else {
    $body = $schedule->get_all_tutors_from_xml();
}
} else {
  $body = $schedule->get_all_tutors_from_xml();
}
include_once $header;
include_once $view;
include_once $footer;
