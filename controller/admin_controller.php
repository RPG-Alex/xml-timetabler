<?php
//set any globals
$title = "";
$body = null;
$view = "view/admin/modAllTutorials.php";
$message;


//instantiate new instance of xml class
include_once "model/xml_class.php";
$admin = new xml_handler;
//Instantiates a new class for handling input safety
include_once "model/input_helper.php";
$inputHandler = new input_helper;
//Create a schedule
if (isset($_POST['submitSchedule'])) {
  if (isset($_POST['tutname']) && $_POST['tutname'] != "") {
    if (strlen($_POST['tutname']) < 31 && strlen($_POST['tutname']) > 0) {
      $tut_input = $inputHandler->cleanInputToLower($_POST['tutname']);
      //Need to sanitize!!!!
      $tutor = $_POST['tutor'];
      //This needs to be eventually sanitized as well. Datetimes could be submitted manually and not correct format!
      $dateTimes = $_POST['checkbox'];
      //This invokes the xml class to create the file
      $message = $admin->createXMLEntry($tut_input,$dateTimes,$tutor);
    } else {
      $message = "That name is too long";
    }

  } else {
    $message = "Adding Tutorial Not Successful. Please make sure you have a tutorial name and have selected tutorial times";
  }
}

//handle post variables
if (isset($_POST['deleteTutorial'])) {
  $tutorial = $_POST['tutorialName'];
  $message = $admin->deleteTutorial($tutorial);
} elseif (isset($_POST['removeName'])) {
  $time = $_POST['time'];
  $entry = $inputHandler->cleanInputNoSpace($_POST['entry']);
  $currentName = $inputHandler->cleanInputToLower($_POST['currentName']);
  $newName = "";
  $message = $admin->updateName($time,$currentName,$newName,$entry);
} elseif (isset($_POST['modName'])) {
  $time = $_POST['time'];
  $entry = $inputHandler->cleanInputNoSpaceToLower($_POST['entry']);
  $currentName = $inputHandler->cleanInputToLower($_POST['currentName']);
  $newName = $inputHandler->cleanInputToLower($_POST['updateName']);
  $message = $admin->updateName($time,$currentName,$newName,$entry);
} elseif (isset($_POST['newName'])) {
  $time = $_POST['time'];
  $entry = $inputHandler->cleanInputToLower($_POST['entry']);
  $currentName = "";
  $newName = $inputHandler->cleanInputToLower($_POST['myName']);
  $message = $admin->updateName($time,$currentName,$newName,$entry);
}

//check GET inputs for page assembly
//NEED TO IMPROVE THIS
$tutorList = [];
if (isset($_GET['v'])) {
  $view = $inputHandler->cleanInputNoSpace($_GET['v']);
  if (isset($_GET['tid'])) {
    $tid = $inputHandler->cleanInputNoSpace($_GET['tid']);
  }
  if (file_exists("view/admin/".$view.".php")) {
    if ($view == "singleMod" && isset($_GET['tid'])) {
      $body = $admin->get_tutorial_details($tid);
    }
    $view = "view/admin/".$view.".php";
  } else {
    $message = "That page was not found";
    $body = $admin->get_all_tutors_from_xml();
    $view = "view/admin/modAllTutorials.php";
}
} elseif (isset($_GET['teacher']) && strlen($_GET['teacher']) > 0) {
  $teacher = $inputHandler->cleanInputPeriodsNoSpaces($_GET['teacher']);
  $body = $admin->get_all_xml_files_for_tutor($teacher);
  $view = "view/admin/teacherAllTutorials.php";
} elseif(sizeof($_GET) > 0) {
  $message = "The page you are trying to reach is not valid";
  $body = $admin->get_all_tutors_from_xml();
  $view = "view/admin/modAllTutorials.php";
} else {
  $body = $admin->get_all_tutors_from_xml();
  $view = "view/admin/modAllTutorials.php";
}
//Assemble page
include_once "view/all/admin_all/header.php";
include_once $view;
include_once "view/all/admin_all/footer.php";
