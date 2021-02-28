<h2 style="color: green">All Tutorials</h2>
  <?php

    if ($body != null) {
      echo "<table border='2'>
        <th>
          Tutorial:
        </th>
        <th>
          Action:
        </th>";
      foreach ($body as $single) {
        foreach ($single as $key => $value) {
          //This strips the past file name of the xml
          $key = substr($key,0,-4);
          echo "<tr><td><a href='admin.php?v=singleMod&tid=$key'>$value</a></td><td><form  action='admin.php' method='post'><input type='hidden' name='tutorialName' value='$key'>
          <input type='submit' name='deleteTutorial' value='delete'>
          </form></td><tr>";
        }
      }
    } else {
      echo "<h4 style='color: blue'>No Tutorials Schedule</h4>";
    }

   ?>
</table>
