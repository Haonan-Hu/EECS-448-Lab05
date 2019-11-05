<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $mysqli = new mysqli("mysql.eecs.ku.edu", "hhn97", "duoz3eNg", "hhn97");
  /* check connection */
  if ($mysqli->connect_errno)
  {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }

  $query = "SELECT User_id FROM Users";
  $result = $mysqli->query($query);


  echo "<select name='user'>";

  if ($result->num_rows > 0)
  {
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
      echo "<option value=" . $row["User_id"] . ">" . $row["User_id"] . "</option>";
    }
    echo "</select>";

    /* free result set */
    $result->free();
  }
  else
  {
    echo "The user list is empty\n";
  }

  $mysqli->close();
?>
