<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="https://www.w3schools.com/howto/img_avatar.png" width="50" class="img-responsive" alt="Icon">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">User</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>

		<form role="search" action="search-results.php" name="search" method="POST" enctype="multipart/form-data">


			<!-- <div class="form-group">
				<input type="text" class="form-control" id="searchdata" name="searchdata" placeholder="Search Vehicle-Reg">
			</div> -->

		</form>
		<ul class="nav menu">
			<li class="<?php if($page=="arepliedPrescription") {echo "active";}?>"><a href="arepliedPrescription.php">&nbsp; Replied Prescription</a></li>
			<li class="<?php if($page=="uallRecords") {echo "active";}?>"><a href="sentAllRecords.php">&nbsp; Sent Prescription</a></li>
			<li class="<?php if($page=="newPrescription") {echo "active";}?>"><a href="addPrescription.php">&nbsp; New Prescription</a></li>
			<li class="<?php if($page=="uacceptedPrescription") {echo "active";}?>"><a href="uacceptedPrescription.php">&nbsp; Accepted Prescription</a></li>
            <li class="<?php if($page=="ucanceledPrescription") {echo "active";}?>"><a href="ucanceledPrescription.php">&nbsp; Canceled Prescription</a></li>
			<li class="<?php if($page=="myAccount") {echo "active";}?>"><a href="myAccount.php">&nbsp; My Account</a></li>			
			<li class="<?php if($page=="about") {echo "active";}?>"><a href="about.php">&nbsp; About</a></li>			
		</ul>
		
	</div><!--/.sidebar-->