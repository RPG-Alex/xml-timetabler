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

foreach ($body as $listing) {
    echo "<tr><td><a href='index.php?v=tutorial&teacher=".$listing['xml']->tutor."&id=".$listing['file']."'>".$listing['xml']->tutorial."</a></td>";
  }
} else {
echo "<h4 style='color: blue'>No Tutorials Schedule For This Tutor</h4>";
}
