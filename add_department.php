<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transfer System</title>
  <link rel="stylesheet" type="text/css" href="main.css">
   <style type="text/css">
      /* Styles for the dashboard container */
      .sidebar {
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

<div class="main-content">
  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <center>
            <h1 class="text-center">Kibabii University Faculty Transfer System<br /><small style="font-size:20px">Knowledge For Development</small></h1>
            <img id="mimg" src="images/KIbabii-Logo.png" class="img-responsive" style="width: 100px;" />
          </center>
        </div>
      </div>
    </div>
  </header>

  <div class="content">
 <?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['dep_name'])) {
        // removes backslashes
        $dep_name = stripslashes($_REQUEST['dep_name']);
        //escapes special characters in a string
        $dep_name = mysqli_real_escape_string($con, $dep_name);
        
       
        $query    = "INSERT into `department` (dep_name)
                     VALUES ('$dep_name')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>The Department is Registered Successfully.</h3><br/>
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
      <label for="dep_name">Department Name:</label>
      <input type="text" id="dep_name" name="dep_name" placeholder="...">
       <label for="dep_name">Faculty Id:</label>
     
      
      <input type="submit" class="btn btn-primary" value="Submit" id="cod_sbmt">
      <input type="reset" class="btn btn-secondary ml-2" value="Reset" id="cod_rst">
    </form>
  </div>
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
