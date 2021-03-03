<?php
echo "<h2 style='color: green'>$body->tutor's:</h2><h2 style='color: blue'>$body->tutorial</h2>";
echo "<table border='2'>";
echo "<table border='2'>
    <th>
        TimeSlot:
    </th>
    <th>
        Name:
    </th>";
$timeslot = $body->times;
  foreach ($timeslot->timeslot as $time) {
      $formatDates = DateTime::createFromFormat('D M d Y H:i:s +', $time->attributes()->date_time);
      $dateTime= $formatDates->format('D M d, Y H:i');
      echo "
      <tr><form action='index.php?v=".$_GET['v']."&id=".$_GET['id']."' method='post'>
        <td>$dateTime</td>
        <td>
        <input type='hidden' name ='time' value='".$time->attributes()->date_time."'>
        <input type='hidden' name ='entry' value='".$_GET['id']."'>";
        if ($time->attributes()->student == "") {
          echo "<input type='text' name='myName'>
          <input type='submit' name='addMe' value='Add Me'>";
        } else {
          echo $time->attributes()->student;
        }
        echo "
        </td>
      </form></tr>
      ";
    }
echo "</table>";
     ?>
