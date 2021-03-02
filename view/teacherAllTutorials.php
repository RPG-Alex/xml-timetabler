<?php
if ($body != null) {
  echo "
  <h2 style='color: green'>All Tutorials</h2>
  <table border='2'>
    <th>
      Tutorials For ";
//May need to change this later, currently gets name from GET variable
      $name = $_GET['teacher'];
      echo str_replace("."," ",$name);
      echo ":
    </th>
";
  foreach ($body as $single) {
    foreach ($single as $key => $value) {
      //This strips the past file name of the xml
      $key = substr($key,0,-4);
      echo "<tr><td><a href='index.php?v=tutorial&teacher=".$value->tutor->attributes()->tutor_id."&id=$key'>$value->tutorial</a></td>";
    }
  }
} else {
  echo "<h4 style='color: blue'>No Tutorials Schedule For This Tutor</h4>";
}
