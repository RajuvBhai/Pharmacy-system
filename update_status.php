<?php
session_start();
include('includes/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the prescription ID and status are set
    if (isset($_POST['prescription_id']) && isset($_POST['status'])) {
        // Sanitize the input
        $prescription_id = mysqli_real_escape_string($con, $_POST['prescription_id']);
        $status = mysqli_real_escape_string($con, $_POST['status']);

        // Update the status in the database
        $query = "UPDATE prescriptions SET STATUS = '$status' WHERE PID = '$prescription_id'";
        if (mysqli_query($con, $query)) {
            echo "Status updated successfully.";
        } else {
            echo "Error updating status: " . mysqli_error($con);
        }
    } else {
        echo "Prescription ID or status is missing.";
    }
} else {
    echo "Invalid request method.";
}

mysqli_close($con);
?>
