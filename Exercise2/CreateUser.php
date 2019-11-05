<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $newUser = $_POST['user'];
  $nameExist = false;
  $mysqli = new mysqli("mysql.eecs.ku.edu", "hhn97", "duoz3eNg", "hhn97");
  /* check connection */
  if ($mysqli->connect_errno)
  {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }

  $query = mysqli_query($mysqli, "SELECT * FROM `Users` WHERE User_id='".$newUser."'");
  if (!$query)
  {
      die('Error: ' . mysqli_error($mysqli));
  }

  if(mysqli_num_rows($query) > 0)
  {
    $nameExist = true;
  }

  $query = "SELECT Users, User_id FROM Users";
  if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        printf ("%s (%s)\n", $row["User_id"]);
    }

    /* free result set */
    $result->free();
  }
  else
  {
    $temp = "INSERT INTO Users(User_id) VALUES ('$newUser')";
    if($newUser == '')
    {
      echo "Can not leave blank\n";
    }
    else if($nameExist)
    {
      echo "User already exists\n";
    }
    else
    {
      $mysqli->query($temp);
      echo "Successfully created\n";
    }
  }

  $mysqli->close();
?>
