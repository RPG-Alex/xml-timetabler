<?php
    if ($body != null) {
      echo "
      <h2 style='color: green'>All Tutorials</h2>
      <table border='2'>
        <th>
          Tutorial For ";
          $name = $_GET['teacher'];
          echo str_replace("."," ",$name);
          echo "
        </th>
        <th>
          Action:
        </th>";
      foreach ($body as $listing) {
          echo "<tr><td><a href='admin.php?v=singleMod&teacher=".$listing['xml']->tutor."&tid=".$listing['file']."'>".$listing['xml']->tutorial."</a></td><td><form  action='admin.php?teacher=".$listing['xml']->tutor->attributes()->tutor_id."' method='post'><input type='hidden' name='tutorialName' value='".$listing['file']."'>
          <input type='submit' name='deleteTutorial' value='delete'>
          </form></td><tr>";
        }
    } else {
      echo "<h4 style='color: blue'>No Tutorials Schedule For This Tutor</h4>";
    }
