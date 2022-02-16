<DOCTYPE html>
<html>

<body>
<?php
    require('conn.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $usertype = stripslashes($_REQUEST['usertype']);
        $usertype = mysqli_real_escape_string($conn, $usertype);
        
        $create_datetime = date("Y-m-d H:i:s");
        //if  $usertype == admin
        if ($usertype == "admin"){
            $status = 1;
        }
         else{
             $status =0;
         }
  
        //else
    
        // $status = 0

        $query  = "INSERT into `loginsys` (username, password, email, usertype , create_datetime, status)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$usertype', '$create_datetime', '$status')";
        $result   = mysqli_query($conn, $query);
        if ($result) {
            echo "<div class='form'>
    
                  <h1>THIS IS USER HOME PAGE .</h1><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <select name="usertype">
        <option name="usertype"  value="">Select</option>
        <option name="usertype" value="User">user</option>
        <option name="usertype" value="admin">admin</option>
        </select>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>