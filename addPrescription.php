<?php
session_start();
include('includes/dbcon.php');

$note = "";
$delivery_address = "";
$delivery_time = "";

if(isset($_POST["submit"])){
  // Get form data
  $note = $_POST['note']; 
  $delivery_address = $_POST['delivery_address']; 
  $delivery_time = $_POST['delivery_time']; 

  // Get user ID from session
  $user_id = $_SESSION['psuid'];

  // Get user details from database
  $query = "SELECT name, email FROM users WHERE uid = ?";
  $stmt = $con->prepare($query);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  $stmt->close();

  $user_name = $user['name'];
  $user_email = $user['email'];

  // Check if user details are fetched successfully
  if(!$user_name || !$user_email || !$user_id) {
    echo "<script>alert('Failed to fetch user details');</script>";
  } else {
    $totalFiles = count($_FILES['fileImg']['name']);
    $filesArray = array();

    // Check if totalFiles exceeds 5
    if($totalFiles > 5) {
      echo "<script>alert('You can upload maximum 5 images');</script>";
    } else {
      for($i = 0; $i < $totalFiles; $i++){
        $imageName = $_FILES["fileImg"]["name"][$i];
        $tmpName = $_FILES["fileImg"]["tmp_name"][$i];

        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));

        $newImageName = uniqid() . '.' . $imageExtension;

        move_uploaded_file($tmpName, 'uploads/' . $newImageName);
        $filesArray[] = $newImageName;
      }

      $filesArray = json_encode($filesArray);

      $stmt = $con->prepare("INSERT INTO prescriptions (user_id, user_name, user_email, note, delivery_address, delivery_time, intime, filesArray, STATUS) VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, ?, 'NR')");
      $stmt->bind_param("issssss", $user_id, $user_name, $user_email, $note, $delivery_address, $delivery_time, $filesArray);

      $stmt->execute();
      $stmt->close();

      echo "<script>alert('Successfully Added');</script>";
      header("Location: sentAllRecords.php");
      exit();
    }
  }
}
?>

<html>
  <head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Prescription</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
  </head>
  <body>    
      <?php include 'includes-2/navigation.php' ?>

      <?php
      $page="newPrescription";
      include 'includes-2/sidebar.php'
      ?>
      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="container mt-5">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header"><?php include 'includes-2/greetings.php'?></h1>
              </div>
            </div>
            <div class="container my-5">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">Note</label><br>
                  <div>
                    <textarea class="col-sm-3 col-form-label" name="note" cols="30" rows="7" maxlength="150" required><?php echo $note; ?></textarea>
                  </div>
                </div><br/>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">Delivery Address</label>
                  <div>
                    <textarea class="col-sm-3 col-form-label" name="delivery_address" id="delivery_address" cols="30" rows="5" maxlength="100" required><?php echo $delivery_address; ?></textarea>
                  </div>
                </div><br/>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">Delivery Time</label>
                    <input class="col-sm-3 col-form-label" type="time" placeholder="Enter Your Password" name="delivery_time" value="<?php echo $delivery_time; ?>" required>
                </div><br/>
                <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prescription Images</label>
                <input class="col-sm-3 col-form-label" type="file" name="fileImg[]" accept=".jpg, .jpeg, .png" required multiple> <br>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div><br/>
              </form>
              <?php include 'includes/footer.php'?>
            </div>
          </div>
        </div>
  </body>
</html>
