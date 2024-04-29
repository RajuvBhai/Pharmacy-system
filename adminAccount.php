<?php
session_start();
error_reporting(0);
include('includes/dbcon.php');

if (isset($_SESSION['psaid']) && strlen($_SESSION['psaid']) > 0) {
    if (isset($_POST['submit-profile'])) {
        $adminid = $_SESSION['psaid'];
        $aname = $_POST['adminname'];
        $mobno = $_POST['contactnumber'];

        // Using prepared statement to prevent SQL injection
        $query = $con->prepare("UPDATE admin SET AdminName = ?, MobileNumber = ? WHERE ID = ?");
        $query->bind_param("ssi", $aname, $mobno, $adminid);

        if ($query->execute()) {
            $msg = "Admin profile has been updated.";
        } else {
            $msg = "Something went wrong. Please try again.";
        }
        $query->close();
    }
} else {
    header('location:logout.php');
    exit(); 
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VPS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navigation.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="panel panel-default">
            <div class="panel-heading">Profile</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <?php if (isset($msg)): ?>
                        <div class="alert bg-info" role="alert">
                            <em class="fa fa-lg fa-warning">&nbsp;</em> <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <?php
                        $adminid = $_SESSION['psaid'];
                        $ret = mysqli_query($con, "SELECT * FROM admin WHERE ID='$adminid'");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" value="<?php echo $row['AdminName']; ?>" id="adminname" name="adminname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>Username</label>
                                    <input type="text" class="form-control" value="<?php echo $row['UserName']; ?>" id="username" name="username" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="<?php echo $row['Email']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>Contact Number</label>
                                    <input type="number" class="form-control" name="contactnumber" type="email" value="<?php echo $row['MobileNumber']; ?>" required="true">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <center>
                                    <button type="submit" class="btn btn-info" name="submit-profile">Make Changes</button>
                                </center>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
