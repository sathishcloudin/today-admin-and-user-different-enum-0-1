<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('conn.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
         
        // Check user is exist in the database
        $query    = "SELECT * FROM `loginsys` WHERE  username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $res = mysqli_fetch_array($result);
        //print_r($res);
       // print_r($res);
        $role = $res['usertype'];
        //$stat = $res['status'];
        $stat = $res['status'];
       $rows = mysqli_num_rows($result);
       
        if ($stat == 1){       
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = $role;
            
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
                     echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
        }
        else {
      
            echo ("please verify ur account");
        }
        
        
    } else {  

?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">New Registration</a></p>
  </form>
<?php
    }
?>
</body>
</html>
