DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transfer System</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <style type="text/css">
      /* Styles for the dashboard container */
      .sidebar{
        background-color: #f8f9fa;
        height: 100vh;
        width: 200px;
        position: fixed;
        left: 0;
        top: 0;
      }
      
      /* Styles for the main content container */
      .main {
        margin-left: 200px;
        padding: 20px;
      }
      
      /* Styles for the form */
      .deptForm {
        width: 80%;
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
    </style>
  </head>
  <body>
    <div class="sidebar">
      <!-- Dashboard content here -->

       <center> <img id="mimg" src="images/KIbabii-Logo.png" class="img-responsive" /></center>
      <center><h3><strong>COD Dashboard</strong></h3></center>
  <a href="add_students.php">Register New Student</a>
  <a href="add_cod.php">Register COD</a>
  <a href="add_department.php">Add Department</a>
  <a href="add_faculty.php">Add Faculty</a>
  <hr>
  <a href="check_appl.php">New Applications</a>
  <a href="#">Approved Applications</a>
  <a href="#">Rejected Applications</a>
  <hr>
  <a href="#">Reports</a>
  <a href="#">Settings</a>
  <a href="#">Logout</a>

    </div>
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


<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);

        $regno    = stripslashes($_REQUEST['regno']);
        $regno    = mysqli_real_escape_string($con, $regno);

        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $dep_id =stripslashes($_REQUEST["dep_id"]);
  $dep_id= mysqli_real_escape_string($con,$dep_id); 
       
        $query    = "INSERT into `student` (username, regno, email, password,dep_id)
                     VALUES ('$username', '$regno', '$email','" . md5($password) . "','$dep_id')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  </div>";
        }
    } else 
?>


      <form method="post" action="" class="deptForm">
        <hr>
        <label for="stud_name">Student's Name:</label>
        <input type="text" id="stud_name" name="username" placeholder="..." required>

        <label for="regno"></label>Student's Registration Number:</label>
        <input type="text" id="regno" name="regno" placeholder="..." required>

        <label for="email">Student's Email:</label>
        <input type="text" id="email" name="email" placeholder="..." required>

        <label for="password">Student's Default Password:</label>
        <input type="password" id="password" name="password" placeholder="..." required>
       
<label for="dep_id">Department ID</label>
    <input type="password" id="Password" name="dep_id" placeholder="Department ID...">


           <input type="submit" class="btn btn-primary" value="Submit" id="cod_sbmt">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset" id="cod_rst">
        

    </form>


</div>

</body>

<footer class="footer">
    <div class="container-fluid">
    <div class="row">
        <div>
<center>Copyright © 2022 Vouma. All Rights Reserved.</center>
        </div>
    </div>
    </div>
  </footer>
</html>
        
