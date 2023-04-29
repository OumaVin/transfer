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

      #table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #4CAF50;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.approve-btn {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 3px;
  cursor: pointer;
}

.reject-btn {
  background-color: #f44336;
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 3px;
  cursor: pointer;
}

.approve-btn:hover, .reject-btn:hover {
  opacity: 0.8;
}

    
    </style>
  </head>
  <body>
    <div class="sidebar">
      <!-- Dashboard content here -->

       <center> <img id="mimg" src="images/KIbabii-Logo.png" class="img-responsive" /></center>
      <center><h3><strong>Admin Dashboard</strong></h3></center>
  <a href="add_students.php">Register New Students</a>
  <a href="add_courses.php">Register COD</a>
  <a href="add_department.php">Add Department</a>
  <a href="add_faculty.php">Add Faculty</a>
  <hr>
  <a href="check_appl.php">New Applications</a>
  <a href="#">Approved Applications</a>
  <a href="#">Rejected Applications</a>
  <hr>
  <a href="#">Reports</a>
  <a href="#">Settings</a>
  <a href="login.php">Logout</a>
  
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

      <hr>



      <?php
require('db.php');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


// Retrieve all the pending orders
$sql = "SELECT * FROM `details` WHERE `status` = '1'";

$result = $con->query($sql) or die(mysqli_error($con));

if ($result->num_rows > 0) {
    echo "<table border='1' id='table'>";
    echo "<tr><th>Application ID</th><th>current_program</th><th>program_applying_for</th><th>KCSE_slip</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
             <td>" . (isset($row["detail_id"]) ? $row["detail_id"] : "") . "</td>
              <td>" . (isset($row["current_program"]) ? $row["current_program"] : "") . "</td>
              <td>" . $row["program_applying_for"] . "</td>
              <td>" . $row["KCSE_slip"] . "</td>
              <td>
                  <button class='approve-btn' value='' id='approve-btn-" . (isset($row["detail_id"]) ? $row["detail_id"] : "") .  "' onclick='approveOrder(" . (isset($row["detail_id"]) ? $row["detail_id"] : "") .  ")'>Approve</button>
                  <button class='reject-btn' onclick='rejectOrder(" . (isset($row["detail_id"]) ? $row["detail_id"] : "") .  ")'>Reject</button>
              </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No pending orders.";
}

$con->close();
?>

<script>
function approveOrder(detail_id) {
  // Send an AJAX request to the server to update the order status
  $.ajax({
    url: 'approve.php',
    type: 'POST',
    data: {detail_id: detail_id, status: 'approved'},
    success: function(response) {
      // Display a success message to the user
      alert('Order has been approved!');
      // Update the UI to reflect the new status of the order
      $('#approve-btn-' + detail_id).replaceWith('<span class="approved-text">Approved</span>');
    },
    error: function() {
      // Display an error message to the user
      alert('There was an error approving the order. Please try again later.');
    }
  });
}

function rejectOrder(detail_id) {
  // Send an AJAX request to the server to update the order status
  $.ajax({
    url: 'reject.php',
    type: 'POST',
    data: {detail_id: detail_id, status: 'rejected'},
    success: function(response) {
      // Display a success message to the user
      alert('Order has been rejected!');
      // Update the UI to reflect the new status of the order
      $('#approve-btn-' + detail_id).replaceWith('<span class="rejected-text">Rejected</span>');
    },
    error: function() {
      // Display an error message to the user
      alert('There was an error rejecting the order. Please try again later.');
    }
  });
}
</script>


</div>
<center><img src="images/admin.png"></center> 
</body>

        <div class="footer">
<center>Copyright © 2022 Vouma. All rights reserved.</center>
        </div>
    </div>
    </div>
  </footer>
</html>
