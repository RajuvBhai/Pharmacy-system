<?php
session_start();
include('includes/dbcon.php');

$Name = "";
$Address = "";
$Password = "";
$Email = "";
$Mobile = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST["Name"];
    $Address = $_POST["Address"];
    $Password = $_POST["Password"];
    $Email = $_POST["Email"];
    $Mobile = $_POST["Mobile"];

    try {
        // Add new User to the database using prepared statement
        $sql = "INSERT INTO `users` (`Name`, `Address`, `Password`, `Email`, `Mobile`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $con->error);
        }
        $stmt->bind_param("sssss", $Name, $Address, $Password, $Email, $Mobile);
        if (!$stmt->execute()) {
            throw new Exception("Query execution failed: " . $stmt->error);
        }
        echo "<script>alert('User added successfully');</script>";
        echo "<script>window.location.href ='userLogin.php'</script>";
        $Name = "";
        $Address = "";
        $Password = "";
        $Email = "";
        $Mobile = "";
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <center><h2><b>Create New User Account</b></h2></center>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Enter Your Name" name="Name" maxlength="50" value="<?php echo $Name; ?>" required>
                </div>
            </div><br/>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Enter Address" name="Address" maxlength="100" value="<?php echo $Address; ?>" required>
                </div>
            </div><br/>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" placeholder="Enter Password" name="Password" maxlength="24" value="<?php echo $Password; ?>" required>
                </div>
            </div><br/>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" placeholder="Enter Your Email" name="Email" maxlength="48" value="<?php echo $Email; ?>" required>
                </div>
            </div><br/>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mobile Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Enter Your Mobile Number" maxlength="10" name="Mobile" value="<?php echo $Mobile; ?>" required>
                </div>
            </div><br/>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a type="submit" class="btn btn-warning" href="index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <?php include 'includes/footer.php'?>

</body>
</html>
