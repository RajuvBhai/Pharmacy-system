<?php
    session_start();
    include('includes/dbcon.php');
    if (strlen($_SESSION['psaid']==0)) {
        header('location:logout.php');
        } else {

$query = "SELECT * FROM invoice";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>    
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navigation.php' ?>
	
    <?php
    $page="Replies";
    include 'includes/sidebar.php'
    ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">      
        <div class="row">
            <div class="col-lg-12">
                <center><h1 class="page-header">Invoice Management</h1></center>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="panel-heading"><center>Incoming Invoice</center></div>
                    <div class="panel-body">
                    <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">                        
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Customer Name</td>
                            <td>Delivery Address</td>
                            <td>Delivery Time</td>
                            <td>Prescription</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $ret=mysqli_query($con,"SELECT * FROM invoice WHERE Status='' ORDER BY InTime DESC");
                        $ret=mysqli_query($con,"SELECT * FROM invoice ORDER BY INVOICE_DATE DESC");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($ret)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt;?></td>
                            <td><?php  echo $row['CNAME'];?></td>
                            <td><?php  echo $row['CADDRESS'];?></td>
                            <td><?php  echo $row['delivery_time'];?></td>            
                            <td>
                                <a href="view_prescription.php?SID=<?php echo $row['SID']; ?>"><button type="button" class="btn btn-sm btn-danger">View</button></a>
                            </td>
                        </tr>
                            <?php $cnt=$cnt+1;}?>                            
                        </tbody>

                    </table>
                    </div>
                    </div>
                </div> 
            </div>  
            <?php include 'includes/footer.php'?>
        </div>            
    </div>
    <?php include 'includes/footer.php'?>

</body>
</html>
<?php }  ?>