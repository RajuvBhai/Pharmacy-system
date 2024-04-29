<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="https://www.w3schools.com/howto/img_avatar.png" width="50" class="img-responsive" alt="Icon">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Admin</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>

		<form role="search" action="search-results.php" name="search" method="POST" enctype="multipart/form-data">


			<div class="form-group">
				<input type="text" class="form-control" id="searchdata" name="searchdata" placeholder="Search Customer Name">
			</div>

		</form>
		<ul class="nav menu">
			<li class="<?php if($page=="allRecords") {echo "active";}?>"><a href="allRecords.php">&nbsp; Received Prescription</a></li>
			<li class="<?php if($page=="repliedPrescription") {echo "active";}?>"><a href="repliedPrescription.php">&nbsp; Responsed Prescription</a></li>
			<li class="<?php if($page=="acceptedPrescription") {echo "active";}?>"><a href="acceptedPrescription.php">&nbsp; Accepted Prescription</a></li>
            <li class="<?php if($page=="canceledPrescription") {echo "active";}?>"><a href="canceledPrescription.php">&nbsp; Canceled Prescription</a></li>
			<li class="<?php if($page=="adminAccount") {echo "active";}?>"><a href="adminAccount.php">&nbsp; Admin Account</a></li>			
		</ul>
		
	</div>