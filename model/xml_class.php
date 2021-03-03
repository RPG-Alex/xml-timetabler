<?php

class xml_handler{
  public $xml_directory = "scheduled_meetings";
  public $teachers = "teacher-list.xml";

  public function createXMLEntry($tutorial_name,$selectedTimes,$tutor){

    $dom = new DOMDocument();
    $dom->encoding = 'utf-8';
    $dom->xmlVersion = '1.0';
    $dom->formatOutput = true;
    //This creates the file name
    $cleanName = preg_replace("/[^a-zA-Z0-9]+/", "", $tutorial_name);
    $xml_file_name = "$this->xml_directory/$cleanName.xml";

    //Need to check if file exists
    if (file_exists($xml_file_name)) {
      $message = "A Timetable With This Name Already Exists, Please Try Again and Select A Unique Name";
    } else {
      $root_node = $dom->createElement('all_tutorials');
      $tut_name = $dom->createElement('tutorial',$tutorial_name);

      //Re-Add spaces for tutor names
      $tutor_name = str_replace('.',' ',$tutor);
      $tutor_name = $dom->createElement('tutor',$tutor_name);

      $tutorAsAttribute = new DOMAttr('tutor_id',$tutor);
      $tutor_name->setAttributeNode($tutorAsAttribute);

      $times = $dom->createElement('times');
      foreach ($selectedTimes as $singleTime) {
        $time_node = $dom->createElement('timeslot');
        $time_as_attribute = new DOMAttr('date_time',$singleTime);
        $student_as_attribute = new DOMAttr('student','');
        $time_node->setAttributeNode($time_as_attribute);
        $time_node->setAttributeNode($student_as_attribute);
        $times->appendChild($time_node);
      }
      $root_node->appendChild($tut_name);
      $root_node->appendChild($tutor_name);
      $root_node->appendChild($times);
      $dom->appendChild($root_node);
      if ($dom->save($xml_file_name)) {
        $message = "Tutorial Added";
      } else {
        $message = "Something isn't working on our end";
      }
    }
    return $message;
  }
  public function get_all_xml_files_for_tutor($tutor){
    //This will return an array of the xml files for existing tutorials
    $getDirectoryContent = scandir("$this->xml_directory");
    // need to make this an array. Needs to have file name and the tutorial name
    $all_found = [];
    foreach ($getDirectoryContent as $file) {
      if ($file != "." AND $file != "..") {
        $afile = "$this->xml_directory/$file";
        $xml = simplexml_load_file("$afile");
        if ($xml->tutor->attributes()->tutor_id == $tutor) {
          $all_found[] =
          [
            'file' => substr($file,0,-4),
            'xml' => $xml
          ];
        }
      }
    }
    return $all_found;
  }

  public function get_all_tutors_from_xml(){
    //This will return an array of the xml files for existing tutorials
    $getDirectoryContent = scandir("$this->xml_directory");
    // need to make this an array. Needs to have file name and the tutorial name
    $all_tutors = [];
    foreach ($getDirectoryContent as $file) {
      if ($file != "." AND $file != "..") {
        $afile = "$this->xml_directory/$file";
        $xml = simplexml_load_file("$afile");
        $all_tutors[] = $xml->tutor;
      }
    }
    return $all_tutors;
  }

  public function get_tutorial_details($tutorial_name){
    $file = "$this->xml_directory/$tutorial_name.xml";
    if (file_exists($file)) {
      $xml = simplexml_load_file("$file");
      return $xml;
  }
}

  public function getTeachers(){
    if (file_exists($this->teachers)) {
      $xml = simplexml_load_file("$this->teachers");
      $aTeacher = $xml->teacher;
      for ($i=0; $i < count($aTeacher) ; $i++) {
        $teacherName = $aTeacher[$i]->attributes()->name;
        $teacherId = $aTeacher[$i]->attributes()->id;
        $message[] = ["$teacherId" => $teacherName];
    }

  } else {
    $message = "This File does not Exist, The teacher list has been lost";
  }
  return $message;
}

  //This function will delete all files in directory that are older than 90 days
  public function clear_old(){
    $getDirectoryContent = scandir("$this->xml_directory");
    foreach ($getDirectoryContent as $file) {
      if ($file != "." AND $file != "..") {
        $file = "$this->xml_directory/$file";
          if ((time()-filemtime("$file") > 7776000)) {
            // delete old files here. The comparision is defaulting to 90 days
             unlink($file);
          }
        }
      }
  }

  //This function will delete the xml file
  public function deleteTutorial($tutorial){
    if (file_exists("$this->xml_directory/$tutorial.xml")) {
      $file = "$this->xml_directory/$tutorial.xml";
      unlink($file);
      return "Tutorial Successfully Deleted";
    } else {
      return "Cannot find tutorial file";
    }
  }

  public function updateName($time,$currentName,$newName,$entry){
    $file = "$this->xml_directory/".$entry.".xml";
    $xml = simplexml_load_file($file);
    //This should be locking my file as a stream
    $stream = fopen($file,'r+');

    if (flock($stream,LOCK_EX)) {
      //this will only execute if the file has been locked
      if ($xml->xpath("//all_tutorials/times/timeslot[@date_time='$time']")[0]) {
        if ($xml->xpath("//all_tutorials/times/timeslot[@date_time='$time']")[0]->attributes()['student']==$currentName) {
          $xml->xpath("//all_tutorials/times/timeslot[@date_time='$time']")[0]->attributes()['student'] = $newName;
          $xml->asXML($file);
          return $message="Successfully updated name!";
          } else {
            return $message = "Unable to update name";
          }
        }
      }
       else {
        return $message="Something has gone wrong. Name not updated";
      }
      //This releases the file stream for editing
      fclose($stream);
    }


  public function addName($time,$name,$entry){
    $file = "$this->xml_directory/".$entry.".xml";
    $xml = simplexml_load_file($file);
    //This should be locking my file as a stream
    $stream = fopen($file,'r+');

    if (flock($stream,LOCK_EX)) {
      //this will only execute if the file has been locked
      if ($xml->xpath("//all_tutorials/times/timeslot[@date_time='$time']")[0]) {
        if ($xml->xpath("//all_tutorials/times/timeslot[@date_time='$time']")[0]->attributes()['student']=='') {
          $xml->xpath("//all_tutorials/times/timeslot[@date_time='$time']")[0]->attributes()['student'] = $name;
          $xml->asXML($file);
          return $message="Successfully added name!";
        } else {
          return $message = "That slot has already been taken";
        }
      }
    }
     else {
      return $message="Something has gone wrong. Name not added";
    }
    //This releases the file stream for editing
    fclose($stream);
  }
}
