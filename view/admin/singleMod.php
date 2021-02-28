  <table border='2'>
    <th>
        TimeSlot:
    </th>
    <th>
        Name:
    </th>
    <th>Actions:</th>
    <?php
      foreach ($body as $entry) {
        foreach ($entry as $key => $value) {
          $formatDates = DateTime::createFromFormat('D M d Y H:i:s +', $key);
          $dateTime= $formatDates->format('D M d, Y H:i');
          echo "
          <tr><form action='admin.php?v=".$_GET['v']."&tid=".$_GET['tid']."' method='post'>
            <td>$dateTime</td>
            <td>
            <input type='hidden' name ='time' value='$key'>
            <input type='hidden' name ='entry' value='".$_GET['tid']."'>";
            if ($value == "") {
              echo "<font color='red'>Empty</font></td><td><input type='text' name='myName'><input type='submit' name='newName' value='Add Name'>";
            } else {
              echo "$value</td><td><input type='hidden' name='currentName' value='$value'><input type='submit' value='Remove Name' name='removeName'><input type='submit' value='Modify Name' name='modName'><input type='text' name='updateName' placeholder='update name'>";
            }
            echo "
            </td>
          </form></tr>
          ";
        }
      }

     ?>

  </table>
