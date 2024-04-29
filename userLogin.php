<?php
session_start();
include('includes/dbcon.php');

if (isset($_POST['login'])) {
    $Email = mysqli_real_escape_string($con, $_POST['Email']); // Sanitize input
    $Password = $_POST['Password']; // Don't hash yet
    
    $query = mysqli_prepare($con, "SELECT UID FROM users WHERE Email=? AND Password=?");
    mysqli_stmt_bind_param($query, "ss", $Email, $Password); // Changed "is" to "ss" for string parameters
    mysqli_stmt_execute($query);
    mysqli_stmt_store_result($query);
    
    if (mysqli_stmt_num_rows($query) == 1) {
        // Bind the result to a variable
        mysqli_stmt_bind_result($query, $UID);
        mysqli_stmt_fetch($query); // Fetch the result into variables
        
        $_SESSION['psuid'] = $UID;
        header('location:arepliedPrescription.php');
        exit(); // Ensure no further code execution after redirection
    } else {
        $msg = "Invalid Email or Password";
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
        <center><h2><b>Pharmacy Management System</b></h2></center>
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
                            <input class="form-control" placeholder="Email" name="Email" type="text" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="Password" type="Password" required>
                        </div>
                        <button class="btn btn-success" type="submit" name="login">Login as an User</button>
                        <a class="btn btn-primary" href="createUserAccount.php" role="button">Create a user account</a>
                        <a type="submit" class="btn btn-danger" href="index.php" role="button">Cancel</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div> 
<?php include 'includes/footer.php'?>

</body>
</html>
