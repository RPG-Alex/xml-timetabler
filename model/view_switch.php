<?php
class view_switch{
  

  include_once "view/all/header.php";
  if (isset($_GET['v'])) {
    if (file_exists("view/".$_GET['v'].".php")) {
      if ($_GET['v'] == "tutorial" && isset($_GET['id'])) {
        $body = $schedule->get_tutorial_details($_GET['id']);
      }
      include_once "view/".$_GET['v'].".php";
    } else {
      $body = $schedule->get_all_xml_files();
    include_once "view/allTutorials.php";
  }
  } else {
    $body = $schedule->get_all_xml_files();
    include_once "view/allTutorials.php";

  }
  include_once "view/all/footer.php";

}
