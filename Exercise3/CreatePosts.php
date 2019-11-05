<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $userID = $_POST['user'];
  $post   = $_POST['post'];
  $userExist = false;
  $mysqli = new mysqli("mysql.eecs.ku.edu", "hhn97", "duoz3eNg", "hhn97");
  /* check connection */
  if ($mysqli->connect_errno)
  {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }

  $query = mysqli_query($mysqli, "SELECT * FROM `Users` WHERE User_id='".$userID."'");
  if (!$query)
  {
      die('Error: ' . mysqli_error($mysqli));
  }

  if(mysqli_num_rows($query) > 0)
  {
    $userExist = true;
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
    if($userID == '')
    {
      echo "UserID cannot leave blank\n";
    }
    elseif ($userExist)
    {
      $temp= "INSERT INTO Posts(content) VALUES ('$post')";
      $mysqli->query($temp);
      $insert = mysqli_insert_id($mysqli);
      $setKey = "UPDATE Posts SET Author_id='$userID' WHERE Post_id='$insert'";
      $mysqli->query($setKey);
      echo "Post is created\n";
    }
    else
    {
      echo "User doesn't exist\n";
    }
  }

  $mysqli->close();
?>
