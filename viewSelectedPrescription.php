<?php
session_start();
error_reporting(0);
include('includes/dbcon.php');

if(isset($_POST["submit"])) {
    $cid = intval($_GET['PID']);
    
    // Update prescription status
    $updatePrescriptionStatus = mysqli_prepare($con, "UPDATE prescriptions SET STATUS='SENT' WHERE PID = ?");
    mysqli_stmt_bind_param($updatePrescriptionStatus, "i", $cid);
    mysqli_stmt_execute($updatePrescriptionStatus);
    mysqli_stmt_close($updatePrescriptionStatus);

    // Update prescriptions details
    $updateInvoiceQuery = "UPDATE prescriptions SET pname = ?, price = ?, qty = ?, total = ? WHERE PID = ?";
    $updateInvoiceStatement = mysqli_prepare($con, $updateInvoiceQuery);
    
    foreach ($_POST["pname"] as $index => $pname) {
        $pname = mysqli_real_escape_string($con, $pname);
        $price = mysqli_real_escape_string($con, $_POST["price"][$index]);
        $qty = mysqli_real_escape_string($con, $_POST["qty"][$index]);
        $total = mysqli_real_escape_string($con, $_POST["total"][$index]);

        mysqli_stmt_bind_param($updateInvoiceStatement, "ssiii", $pname, $price, $qty, $total, $cid);
        mysqli_stmt_execute($updateInvoiceStatement);
    }
    
    mysqli_stmt_close($updateInvoiceStatement);

    if(mysqli_affected_rows($con) > 0) {
        echo "<div class='alert alert-success'>Invoice Added. <a href='print.php?id={$cid}' target='_BLANK'>Click</a> here to Print Invoice</div>";
    } else {
        echo "<div class='alert alert-danger'>Invoice Added Failed.</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		<link rel='stylesheet' href='https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css'>
		<script src="https://code.jquery.com/ui/1.13.0-rc.3/jquery-ui.min.js" integrity="sha256-R6eRO29lbCyPGfninb/kjIXeRjMOqY3VWPVk6gMhREk=" crossorigin="anonymous"></script>
		
</head>
<body>                         
	<div class="col-md-12">
		<form method="POST">
			<?php
			$cid = $_GET['PID'];
			$ret = mysqli_query($con,"SELECT * from prescriptions where PID='$cid'");
			$cnt = 1;
			while ($row = mysqli_fetch_array($ret)) {
			?> 

			<div class="form-group">
				<label>Prescription ID / Invoice ID</label>
				<input type="text" class="form-control" value="<?php echo $row['PID'];?>" id="PID" name="PID" readonly>
			</div>
			<div class="form-group">
				<label>Customer Name</label>
				<input type="text" class="form-control" value="<?php echo $row['user_name'];?>" id="user_name" name="user_name" readonly>
			</div>
			<div class="form-group">
				<label>Customer Email</label>
				<input type="text" class="form-control" value="<?php echo $row['user_email'];?>" id="user_email" name="user_email" readonly>
			</div>
			<div class="form-group">
				<label>Note</label>
				<input type="text" class="form-control" value="<?php echo $row['note'];?>" id="note" name="note" readonly>
			</div>
			<div class="form-group">
				<label>Delivery Address</label>
				<input type="text" class="form-control" value="<?php echo $row['delivery_address'];?>" id="delivery_address" name="delivery_address" readonly>
			</div>
			<div class="form-group">
				<label>Sent Time</label>
				<input type="text" class="form-control" value="<?php echo $row['intime'];?>" id="intime" name="intime" readonly>
			</div>
			<div class="form-group">
				<label>Delivery Time</label>
				<input type="text" class="form-control" value="<?php echo $row['delivery_time'];?>" id="delivery_time" name="delivery_time" readonly>
			</div>

			<div style="display: flex; align-items: center; gap: 10px;">
				<?php 
				foreach (json_decode($row["filesArray"]) as $image) {
					echo '<div>';
					echo '<img src="uploads/' . $image . '" width="200">'; 
					echo '<a href="uploads/' . $image . '" target="_blank">View Image</a>';
					echo '</div>';
				}
				?>
			</div>
									
			<?php } ?>
			
			<div class='row'>
				<div class='col-md-12'>
					<h5 class='text-success'>Product Details</h5>
					<table class='table table-bordered'>
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Qty</th>
								<th>Total</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id='product_tbody'>
							<tr>
								<td><input type='text' required name='pname[]' class='form-control'></td>
								<td><input type='text' required name='price[]' class='form-control price'></td>
								<td><input type='text' required name='qty[]' class='form-control qty'></td>
								<td><input type='text' required name='total[]' class='form-control total'></td>
								<td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'> </td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td><input type='button' value='+ Add Row' class='btn btn-primary btn-sm' id='btn-add-row'></td>
								<td colspan='2' class='text-right'>Total</td>
								<td><input type='text' name='grand_total' id='grand_total' class='form-control' required></td>
							</tr>
						</tfoot>
					</table>
					<input type='submit' name='submit' value='Save Invoice' class='btn btn-success float-right'>
				</div>
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function(){
			$("#date").datepicker({
				dateFormat:"dd-mm-yy"
			});
			
			$("#btn-add-row").click(function(){
				var row="<tr> <td><input type='text' required name='pname[]' class='form-control'></td> <td><input type='text' required name='price[]' class='form-control price'></td> <td><input type='text' required name='qty[]' class='form-control qty'></td> <td><input type='text' required name='total[]' class='form-control total'></td> <td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'> </td> </tr>";
				$("#product_tbody").append(row);
			});
			
			$("body").on("click",".btn-row-remove",function(){
				if(confirm("Are You Sure?")){
					$(this).closest("tr").remove();
					grand_total();
				}
			});

			$("body").on("keyup",".price",function(){
				var price=Number($(this).val());
				var qty=Number($(this).closest("tr").find(".qty").val());
				$(this).closest("tr").find(".total").val(price*qty);
				grand_total();
			});
			
			$("body").on("keyup",".qty",function(){
				var qty=Number($(this).val());
				var price=Number($(this).closest("tr").find(".price").val());
				$(this).closest("tr").find(".total").val(price*qty);
				grand_total();
			});			
			
			function grand_total(){
				var tot=0;
				$(".total").each(function(){
					tot+=Number($(this).val());
				});
				$("#grand_total").val(tot);
			}
		});
	</script>
	<?php include 'includes/footer.php'; ?>
</body>
</html>
