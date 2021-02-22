<?php
include "login.php";

if (isset($_POST['name']) && isset($_POST['password'])){
  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $name = validate($_POST['name']);
  $password = validate($_POST['password']);

  if (empty($name)){
    header("Location : login.php?error=Name is required");
    exit();
  }else if (empty($password)) {
    header("Location : login.php?error=Password is required");
    exit();
  }else{
    $sql = "SELECT * FROM users WHERE name='$name' AND password= '$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) ===1){
      $row = mysqli_fetch_assoc($result);
      if ($row['name'] === $name && $row['password'] === $password){
          echo "Hello " . $_POST['name'];

      }

    }else{
      header("Location : login.php?error=Incorect Name or passsword");
      exit();
    }
  }


}else {
  header("Location : login.php");
  exit();
}

?>
