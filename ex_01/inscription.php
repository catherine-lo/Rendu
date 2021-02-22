<html>
    <head></head>
    <body>
        <?php
        if(!empty($_POST)){
            if(!preg_match("/^[a-zA-Z]*$/", $_POST['name'])){
                echo "Invalid name";
            }else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email'])){
                echo "Invalid email";
            }else if($_POST["password"] != $_POST["password_confirmation"]){
                echo "Invalid password or password confirmation";
            }else{
              $connection = new mysqli($host= "localhost", $dbUser= "root", $dbPassword= "root", $dbName= "gecko");

              if (mysqli_connect_error()) {
                die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
              }
              else {
                $SELECT = "SELECT email FROM users WHERE email = ? LIMIT 1";
                $INSERT = "INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, ?)";

                $stmt = $connection->prepare($SELECT);
                $stmt->bind_param("s",$email);
                $stmt->execute();
                 $stmt->bind_result($email);
                 $stmt->store_result();
                 $rnum = $stmt->num_rows;
              echo "User created";
              $statement->prepare("INSERT INTO users (`id`, `name`,`password`,`email`,`created_at`,`is_admin`)
              VALUES ($_POST['name'],$_POST['password'], $_POST['email'], CURDATE())");
              $status = $statement->execute();

            }
            if ($status){
	             $message = array("message" => "Thanks " . $_POST['name'] . " has been added!");
             }else{
	              $message = array("error" => $db->error);
              }

              $statement->close();
        }
        ?>
        <form action="inscription.php" method="post">
            <input type="text"     name="name"                  placeholder="name"                  minlength="3" maxlength="10"><br/>
            <input type="email"     name="email"                placeholder="email">                                             <br/>
            <input type="password" name="password"              placeholder="password"              minlength="3" maxlength="10"><br/>
            <input type="password" name="password_confirmation" placeholder="password_confirmation" minlength="3" maxlength="10"><br/>
            <input type="submit"   name="submit"                value="Submit">
        </form>
    </body>
</html>
