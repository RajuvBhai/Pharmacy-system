<?php
session_start();
include('includes/dbcon.php');

if (isset($_POST['login'])) {
    $adminuser = mysqli_real_escape_string($con, $_POST['username']); // Sanitize input
    $password = $_POST['password']; // Don't hash yet
    
    $query = mysqli_prepare($con, "SELECT ID FROM admin WHERE UserName=? AND Password=?");
    mysqli_stmt_bind_param($query, "ss", $adminuser, $password);
    mysqli_stmt_execute($query);
    mysqli_stmt_store_result($query);
    
    if (mysqli_stmt_num_rows($query) == 1) {
        $_SESSION['psaid'] = $adminuser; // Store admin username instead of AID for simplicity
        header('location:allRecords.php');
        exit(); // Ensure no further code execution after redirection
    } else {
        $msg = "Invalid username or password";
    }

    mysqli_stmt_close($query); // Close the prepared statement
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicle Parking System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <center><h2><b>Prescription Management System</b></h2></center>
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Please Log In To Continue</div>
            <div class="panel-body">
                <form method="POST">
                    <?php if(isset($msg)) : ?>
                        <div class='alert bg-danger' role='alert'>
                            <em class='fa fa-lg fa-warning'>&nbsp;</em> 
                            <?php echo $msg; ?>
                            <a href='#' class='pull-right'>
                                <em class='fa fa-lg fa-close'></em>
                            </a>
                        </div>
                    <?php endif; ?> 

                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Username" name="username" type="text" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" required>
                        </div>
                        <div class="checkbox">
                            <a href="forgot-password.php" style="text-decoration:none;">Forgot Password?</a>
                        </div>
                        <button class="btn btn-success" type="submit" name="login">Login as an Admin</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>  
<?php include 'includes/footer.php'?>
</body>
</html>
