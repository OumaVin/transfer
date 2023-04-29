<?php

// Check if the POST data was sent
if(isset($_POST['detail_id']) && isset($_POST['status'])) {
    // Extract the order ID and new status from the POST data
    $detail_id = $_POST['detail_id'];
    $status = $_POST['status'];
    
    // Connect to the database
    $con = mysqli_connect('localhost', 'username', 'password', 'database_name');
    
    // Check if the connection was successful
    if(mysqli_connect_errno()) {
        die('Database connection error: ' . mysqli_connect_error());
    }
    
    // Update the order status in the database
    $sql = "UPDATE details SET status='$status' WHERE detail_id='$detail_id'";
    if(mysqli_query($con, $sql)) {
        // Return a success message
        echo "Order has been updated successfully!";
    } else {
        // Return an error message
        echo "Error updating order: " . mysqli_error($con);
    }
    
    // Close the database connection
    mysqli_close($con);
} else {
    // Return an error message if the POST data was not sent
    echo "Invalid request.";
}

?>
