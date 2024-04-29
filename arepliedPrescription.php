<?php
session_start();
include('includes/dbcon.php');

// Get the user ID from the session
$user_id = $_SESSION['psuid'];

// Query to fetch details where psuid = UID and status is 'NR'
$query = "SELECT * FROM prescriptions WHERE user_id = ? AND STATUS = 'SENT'";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$stmt->close();
$con->close();
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
    <?php include 'includes-2/navigation.php' ?>
	
    <?php
    $page="arepliedPrescription";
    include 'includes-2/sidebar.php'
    ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="container mt-5">
            <center><h1 class="mb-4">Replied Prescriptions</h1></center>
            <table id="example" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Prescription ID</th>
                        <th>Note</th>
                        <th>Delivery Address</th>
                        <th>Delivery Time</th>
                        <th>Prescription Images</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>           
                <tr>
                    <td><?php echo $row['PID']; ?></td>
                    <td><?php echo $row['note']; ?></td>
                    <td><?php echo $row["delivery_address"]; ?></td>
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
                    <td>
                        <form method="post" action="update_status.php">
                            <input type="hidden" name="prescription_id" value="<?php echo $row['PID']; ?>">
                            <select name="status" class="form-control" required="true">
                                <option value="NR"></option>
                                <option value="ACCEPTED">ACCEPTED</option>
                                <option value="CANCEL">CANCEL</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                        </form>
                    </td>                      
                </tr>                    
                <?php } ?>        
                </tbody>
            </table>
        </div> 
    </div> 
    <?php include 'includes/footer.php'?>
    	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>

</body>
</html>
