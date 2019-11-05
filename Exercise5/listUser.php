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
  if($result->num_rows > 0)
  {
    echo "<table>";
    echo "<th>User</th>";
    /* fetch associative array */
    while ($row = $result->fetch_assoc())
    {
      echo '<tr>';
        echo '<td>';
          echo $row["User_id"];
        echo '</td>';
      echo '</tr>';
    }
    echo "</table>";

    /* free result set */
    $result->free();
  }
  else
  {
    echo "The table is empty\n";
  }

  $mysqli->close();
?>
