<html>
    <body>
        <?php
        if (isset($_POST['submit'])){
          $name = $_POST['name'];
          $password = $_POST['password'];
          $email=$_POST['email'];
          echo "coucou";
        }
        if(!empty($_POST)){
          $dbUser= "root";
          $dbPassword= "root";
          $dbName= "gecko";
          $db = new PDO('mysql:host=localhost;dbname=' . $dbName . ';charset=utf8', $dbUser, $dbPassword);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if(!preg_match("/^[a-zA-Z]*$/", $_POST['name'])){
                echo "Invalid name";
            }else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email'])){
                echo "Invalid email";
            }else if($_POST["password"] != $_POST["password_confirmation"]){
                echo "Invalid password or password confirmation";
            }

              $sql = "INSERT INTO users (name, password, email, created_at, is_admin) VALUES (?, ?, ?, ?, ?)";
              $stmtinsert = $db->prepare($sql);




              if(  $stmtinsert->execute([$name, $password, $email,date('Y-m-d'), 0])){

                echo "User created";
              }else{
                echo "There were errors while saving the data";
              }
        }
        ?>
        <form action="inscription.php" method="post">
            <input type="text"     name="name"                  placeholder="name"                  minlength="3" maxlength="10"><br/>
            <input type="email"     name="email"                placeholder="email">                                             <br/>
            <input type="password" name="password"              placeholder="password"              minlength="3" maxlength="10"><br/>
            <input type="password" name="password_confirmation" placeholder="password_confirmation" minlength="3" maxlength="10"><br/>
            <input type="submit"   name="submit"                value="submit">
        </form>
    </body>
</html>
