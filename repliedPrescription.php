<?php
session_start();
include('includes/dbcon.php');

// Query to fetch all prescriptions
$query = "SELECT * FROM prescriptions WHERE Status='SENT' ORDER BY InTime DESC";
$result = mysqli_query($con, $query);

// Check if query executed successfully
if(!$result) {
    echo "Error: Failed to fetch prescription details.";
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Prescriptions</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
        <?php include 'includes/navigation.php' ?>
	
        <?php
		$page="repliedPrescription";
		include 'includes/sidebar.php'
		?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="container mt-5">
            <center><h1 class="mb-4">Responsed Prescriptions</h1></center>
            <table id="example" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Prescription ID</th>
                        <th>User Name</th>
                        <th>Note</th>
                        <th>Sent Time</th>
                        <th>Delivery Time</th>
                        <th>Prescription Images</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>           
                <tr>
                    <td><?php echo $row['PID']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row["delivery_address"]; ?></td>
                    <td><?php echo $row["intime"]; ?></td>
                    <td><?php echo $row["delivery_time"]; ?></td>
                    <td style="display: flex; align-items: center; gap: 10px;">
                        <?php 
                        // Check if filesArray is not null and is not empty
                        if (!empty($row["filesArray"])) {
                            // Decode JSON data and ensure it's an array
                            $filesArray = json_decode($row["filesArray"], true);
                            if (is_array($filesArray)) {
                                // Display prescription images
                                foreach ($filesArray as $image) {
                                    echo '<img src="uploads/' . $image . '" width="200">';
                                }
                            } else {
                                echo "Invalid image data";
                            }
                        } else {
                            echo "No images";
                        }
                        ?>
                    </td>                        
                </tr>                    
                <?php } ?>        
                </tbody>
            </table>
        </div> 
    </div> 
    <?php include 'includes/footer.php'?>

</body>
</html>
<?php
}
?>
