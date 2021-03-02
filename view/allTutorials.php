<?php
    if ($body != null) {
      echo "<h2 style='color: green'>All Teachers With Tutorials Scheduled</h2>";
      echo "<table border='2'>
        <th>
          Tutor:
        </th>
        ";
        //This array is used to ensure tutors are not listed twice
        $allTutors = [];
      foreach ($body as $tutor) {
          if (!in_array((string)$tutor->attributes()->tutor_id,$allTutors)) {
            $allTutors[]= (string)$tutor->attributes()->tutor_id;
            echo "<tr><td><a href='index.php?v=teacherAllTutorials&teacher=".(string)$tutor->attributes()->tutor_id."'>".(string)$tutor."</a></td></tr>";
          }
      }
      echo "</table>";
    } else {
      echo "<h2 style='color: blue'>No Tutorials Scheduled For Any Teachers Yet</h2>";
    }
