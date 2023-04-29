<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="main.css"/>
     <style type="text/css">
      
      /* Styles for the main content container */
      .main {
        margin-left: 2px;
        padding: 20px;
      }
      
      /* Styles for the form */
      .deptForm {
        width: 50%;
      }
      
      /* Styles for the header */
      .header {
        background-color: #007bff;
        color: white;
        padding: 20px;
      }
      
      /* Styles for the logo */
      #mimg {
        width: 100px;
      }

         .footer{
        background: blue;
        margin-top: 50%;
        color: white;

    }
     #sbmt{
    background-color: blue;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
    </style>
    </head>
<body>

    <div class="main">
      <header class="header">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <center>
                <h1 class="text-center">Kibabii University Faculty Transfer System<br /><small style="font-size:20px">Knowledge For Development</small></h1>
                <img id="mimg" src="images/KIbabii-Logo.png" class="img-responsive" />
              </center>
            </div>
          </div>
        </div>
      </header>

</div>

<center>

  <form class="deptForm" action="" method="post">
        <h1 class="login-title">Admin Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" id="sbmt">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
    
</center>

<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $time_created = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, time_created)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$time_created')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    }
?>

<center>



</body>
</html>