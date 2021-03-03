    <?php
    echo "<h2 style='color: green'>$body->tutor's:</h2><h2 style='color: blue'>$body->tutorial</h2>";
    echo "<table border='2'>
        <th>
            TimeSlot:
        </th>
        <th>
            Name:
        </th>
        <th>Actions:</th>";
    $timeslot = $body->times;
    foreach ($timeslot->timeslot as $time) {
      $formatDates = DateTime::createFromFormat('D M d Y H:i:s +', $time->attributes()->date_time);
      $dateTime= $formatDates->format('D M d, Y H:i');
      echo "
      <tr><form action='admin.php?v=".$_GET['v']."&teacher".$body->tutor."&tid=".$_GET['tid']."' method='post'>
        <td>$dateTime</td>
        <td>
        <input type='hidden' name ='time' value='".$time->attributes()->date_time."'>
        <input type='hidden' name ='entry' value='".$_GET['tid']."'>";
        if ($time->attributes()->student == "") {
          echo "<font color='red'>Empty</font></td><td><input type='text' name='myName'><input type='submit' name='newName' value='Add Name'>";
        } else {
          echo $time->attributes()->student."</td><td><input type='hidden' name='currentName' value='".$time->attributes()->student."'><input type='submit' value='Remove Name' name='removeName'><input type='submit' value='Modify Name' name='modName'><input type='text' name='updateName' placeholder='update name'>";
        }
        echo "
        </td>
      </form></tr>
      ";
    }
    echo "</table>";
     ?>
