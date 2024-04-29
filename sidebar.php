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

			
		</form>
		<ul class="nav menu">
			<li class="<?php if($page=="allRecords") {echo "active";}?>"><a href="allRecords.php"><em class="fa fa-toggle-on">&nbsp;</em> All Prescriptions</a></li>
            <li class="<?php if($page=="Replies") {echo "active";}?>"><a href="repliedRecords.php"><em class="fa fa-toggle-off">&nbsp;</em> Replied Prescriptions</a></li>
			<li class="<?php if($page=="#") {echo "active";}?>"><a href="total-income.php"><em class="fa fa-dollar">&nbsp;</em> Accepted Income</a></li>
			<li class="<?php if($page=="#") {echo "active";}?>"><a href="reports.php"><em class="fa fa-file">&nbsp;</em> Canceled Prescriptions</a></li>
			<li class="<?php if($page=="#") {echo "active";}?>"><a href="about.php"><em class="fa fa-info">&nbsp;</em> About Page</a></li>			
		</ul>
		
	</div>