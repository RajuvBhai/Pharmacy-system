<?php
session_start();
error_reporting(0);
include('includes/dbcon.php');
if (strlen($_SESSION['psaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['searchdata'])) {
        $sdata = $_POST['searchdata'];
        // Query to search prescriptions based on user name
        $query = "SELECT * FROM prescriptions WHERE user_name LIKE ?";
        $stmt = $con->prepare($query);
        $sdata = "%$sdata%"; // Add wildcard characters for partial matching
        $stmt->bind_param("s", $sdata);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    
    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navigation.php' ?>

    <?php include 'includes/sidebar.php' ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
       
        <div class="row">
            <div>
                <div>
                    <div><center><h1>Search Results - Based Upon User Name</h1></center></div>
                    <div class="panel-body">
                        <?php if(isset($_POST['searchdata'])) { ?>
                        <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Prescription ID</th>
                                    <th>User Name</th>
                                    <th>Note</th>
                                    <th>Sent Time</th>
                                    <th>Delivery Time</th>
                                    <th>Prescription Images</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>           
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
                                    <td>
                                        <a href="viewSelectedPrescription.php?PID=<?php echo $row['PID'];?>" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>                    
                                <?php } ?>                        
                            </tbody>
                        </table>
                        <?php } else { ?>
                            <p>No search results found.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>                  
        </div>
        <?php include 'includes/footer.php'?>
    </div>
</body>
</html>
