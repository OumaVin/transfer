<!DOCTYPE html>
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
        color: white;
      }
    </style>
  </head>
  <body>
    <div class="sidebar">
      <!-- Dashboard content here -->
      <center><img id="mimg" src="images/KIbabii-Logo.png" class="img-responsive" /></center>
      <center><h3><strong>Student Dashboard</strong></h3></center>
      <a href="form.php">Apply Here</a>
      <hr>
      <a href="#">Application Status</a>
      <hr>
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
  
  if (isset($_REQUEST['current_program'])) {
    // removes backslashes
    $current_program = stripslashes($_REQUEST['current_program']);
    // escapes special characters in a string
    $current_program = mysqli_real_escape_string($con, $current_program);

    $program_applying_for = stripslashes($_REQUEST['program_applying_for']);
    $program_applying_for = mysqli_real_escape_string($con, $program_applying_for);

    // Code to handle file upload
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $target_dir = "";
        $KCSE_slip = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($KCSE_slip, PATHINFO_EXTENSION));
        // Allow only certain file formats
        $allowed_formats = array("jpg", "png", "jpeg", "gif");
        if (in_array($imageFileType, $allowed_formats)) {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $KCSE_slip)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        echo "No file was uploaded.";
    }
    // Check if KCSE slip was uploaded without errors
    if (isset($_FILES["KCSE_slip"]) && $_FILES["KCSE_slip"]["error"] == 0) {
        $target_dir = "";
        $KCSE_slip = $target_dir . basename($_FILES["KCSE_slip"]["name"]);
        $pdfFileType = strtolower(pathinfo($KCSE_slip, PATHINFO_EXTENSION));
        // Allow only PDF file format
        if ($pdfFileType == "pdf") {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["KCSE_slip"]["tmp_name"], $KCSE_slip)) {
                echo "The file " . htmlspecialchars(basename($_FILES["KCSE_slip"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only PDF files are allowed.";
        }
    } else {
        echo "No file was uploaded.";
    }
}


    // insert values into the database
    $query = "INSERT into `details` (current_program, program_applying_for, KCSE_slip)
              VALUES ('$current_program', '$program_applying_for', '$KCSE_slip')";
    $result = mysqli_query($con, $query);
    if ($result) {
      echo "<div class='form'>
            <h3>You have successfully applied for a transfer.</h3>
            </div>";
    } else {
      echo "<div class='form'>
            <h3>Required fields are missing.</h3>
            </div>";
    }
  }
?>
<form method="post" action="" class="deptForm" enctype="multipart/form-data">
  <hr>

    <fieldset class="fieldset">

    <legend><h5><strong>FILL IN THE FOLLOWING FORM</strong></h5></legend>

     <label for="Programs">YOUR CURRENT PROGRAM:&nbsp;&nbsp;</label>
     <select name="current_program" >
         <option value="IT">IT</option>
         <option value="Computer Science">Computer Science</option>
         <option value="Business Management">Business Management</option>
         <option value="Bachelors in Commerce">Bachelors in Commerce</option>
         <option value="Education Arts">Education Arts</option>
         <option value="Education Science">Education Science</option>
         <option value="Nursing">Nursing</option>
         <option value="Journalism">Journalism</option>
         <option value="Criminology">Criminology</option>
     </select><br>
     <label for="Programs">THE PROGRAM TOU ARE APPLLYING TO SWITCH TO:&nbsp;&nbsp;</label>

      <select name="program_applying_for" >
         <option value="IT">IT</option>
         <option value="Computer Science">Computer Science</option>
         <option value="Business Management">Business Management</option>
         <option value="Bachelors in Commerce">Bachelors in Commerce</option>
         <option value="Education Arts">Education Arts</option>
         <option value="Education Science">Education Science</option>
         <option value="Nursing">Nursing</option>
         <option value="Journalism">Journalism</option>
         <option value="Criminology">Criminology</option>
     </select><br>

      <label for="file-select">UPLOAD YOUR KCSE RESULT SLIP:</label>
     <input type="file" name="KCSE_slip" id="file-select">

     <h5><b>WARNING:-</b></h5><br>
     <li>
         You will be disqualified if you submit application for transfer into more than one degree programme. </li>
        <li>It is a criminal offence, which shall lead to disciplinary action and may further lead to criminal proceedings in a court of law if you give any falsified information of your KCSE Results
     </li><br>
     <h6><b>DECLARATION:-</b></h6>
    declare that I have read and understood the warning herein and that the information I have given in this form is true and correct. </p>
    <center> 
        <hr style="border-top: 1px dotted black;">

     <div class="cod_btns">
                <input type="submit" class="btn btn-primary" value="Submit" id="cod_sbmt">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset" id="cod_rst">
            </div>
     </center>
    

</fieldset>



 </form>
</div>
</body>
</html>