<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $userID = $_POST["user"];
  $mysqli = new mysqli("mysql.eecs.ku.edu", "hhn97", "duoz3eNg", "hhn97");
  /* check connection */
  if ($mysqli->connect_errno)
  {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }


  $query = "SELECT Content FROM Posts WHERE Author_id = '$userID'";
  $result = $mysqli->query($query);
  if($result->num_rows > 0)
  {
    echo "" . $userID . "'s Post: ";
    echo "<br>";
    /* fetch associative array */
    while ($row = $result->fetch_assoc())
    {
      echo $row["Content"];
    };

    /* free result set */
    $result->free();
  }
  else
  {
    echo "Can not find post from this user\n";
  }

  $mysqli->close();
?>
