<!DOCTYPE html>
<html>
<head>
        <title>LOGIN</title>
</head>
<body>
      <?php
        $host= "localhost";
        $username= "root";
        $passwd= "root";
        $port=3306;
        $db="gecko";
        $conn = mysqli_connect($host, $username, $passwd, $port, $db);

        if(!$conn){
          echo "Connection failed";
        }

       ?>

      <form action="index.php" method="POST">
          <h2>LOGIN<h2>
          <?php if (isset($_GET['error'])) {?>
            <p class= "error"><?php echo $_GET['error']; ?></p>


          <label><b>Name</b></label>
          <input type="text"     name="name"          placeholder="Name"><br/>
          <label><b>Password</b></label>
          <input type="password" name="password"      placeholder="Password">

          <button type="submit">Login</button>
      </form>



</body>
</html>
