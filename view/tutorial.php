  <table border='2'>
    <th>
        TimeSlot:
    </th>
    <th>
        Name:
    </th>
    <?php
      foreach ($body as $entry) {
        foreach ($entry as $key => $value) {
          $formatDates = DateTime::createFromFormat('D M d Y H:i:s +', $key);
          $dateTime= $formatDates->format('D M d, Y H:i');
          echo "
          <tr><form action='index.php?v=".$_GET['v']."&id=".$_GET['id']."' method='post'>
            <td>$dateTime</td>
            <td>
            <input type='hidden' name ='time' value='$key'>
            <input type='hidden' name ='entry' value='".$_GET['id']."'>";
            if ($value == "") {
              echo "<input type='text' name='myName'>
              <input type='submit' name='addMe' value='Add Me'>";
            } else {
              echo "$value";
            }
            echo "
            </td>
          </form></tr>
          ";
        }
      }

     ?>

  </table>
