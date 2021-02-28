<h2 style="color: green">All Tutorials</h2>
<table>
  <th>
    Tutorial:
  </th>
  <?php
    foreach ($body as $single) {
      foreach ($single as $key => $value) {
        //This strips the past file name of the xml
        $key = substr($key,0,-4);
        echo "<tr><td><a href='index.php?v=tutorial&id=$key'>$value</a></td><tr>";
      }
    }
   ?>
</table>
