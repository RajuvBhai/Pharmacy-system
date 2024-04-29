<?php
session_start();
error_reporting(0);
include('includes/dbcon.php');

if (strlen($_SESSION['psuid']) == 0) {
    header('location:logout.php');
    exit(); 
} else {
    if (isset($_POST['submit-profile'])) {
        $userid = $_SESSION['psuid'];
        $uname = $_POST['Name'];
        $address = $_POST['Address'];
        $password = $_POST['Password'];
        $email = $_POST['Email'];
        $mobno = $_POST['Mobile'];

        $query = $con->prepare("UPDATE users SET Name=?, Address=?, Password=?, Email=?, Mobile=? WHERE UID=?");
        $query->bind_param("ssssis", $uname, $address, $password, $email, $mobno, $userid);

        if ($query->execute()) {
            $msg = "Profile has been updated.";
        } else {
            $msg = "Something went wrong. Please try again.";
        }
        $query->close();
    }
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
    <?php include 'includes-2/navigation.php'; ?>
    <?php include 'includes-2/sidebar.php'; ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="panel panel-default">
            <div class="panel-heading">Profile</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <?php if(isset($msg)): ?>
                        <div class="alert bg-info" role="alert">
                            <em class="fa fa-lg fa-warning">&nbsp;</em> <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <?php
                        $userid = $_SESSION['psuid'];
                        $ret = mysqli_query($con, "SELECT * FROM users WHERE UID='$userid'");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="<?php echo $row['Name']; ?>" id="Name" name="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="<?php echo $row['Address']; ?>" id="Address" name="Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="<?php echo $row['Email']; ?>" id="Email" name="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="Password" value="<?php echo $row['Password']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label>Contact Number</label>
                                    <input type="number" class="form-control" name="Mobile" value="<?php echo $row['Mobile']; ?>" required>
                                </div>
                            </div>
                            <center>
                                <button type="submit" class="btn btn-info" name="submit-profile">Make Changes</button>
                            </center>
                        <?php } ?>
                    </form>
                    <a href="./logout.php">
                        <div class="btn btn-danger">Logout</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
