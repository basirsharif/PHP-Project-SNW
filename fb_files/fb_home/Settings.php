<?php
	session_start();
	error_reporting(1);
	if(isset($_SESSION['fbuser']))
	{
		mysql_connect("localhost","root","");
		mysql_select_db("faceback");
		$user_email=$_SESSION['fbuser'];
		$que_user_info=mysql_query("select * from users where Email='$user_email'");
		$user_data=mysql_fetch_array($que_user_info);
		$userid=$user_data[0];
		$user_name=$user_data[1];
		$user_pass=$user_data[3];
		
		$last_name_pos=strrpos($user_name," ");
		$last_name_pos=$last_name_pos+1;
		$first_name=strstr($user_name,' ',1);
		$last_name=substr($user_name,$last_name_pos,strlen($user_name));
		include("../fb_profile/background.php");
?>
<?php
	if(isset($_POST['change_name']))
	{
		$Name=$_POST['fnm'].' '.$_POST['lnm'];
		mysql_query("update users set Name='$Name' where user_id=$userid;");
		header("location:Settings.php");
	}
	if(isset($_POST['change_password']))
	{
		$old_password=$_POST['old_password'];
		$new_password=$_POST['new_password'];
		if($user_pass==$old_password)
		{
			mysql_query("update users set Password='$new_password' where user_id=$userid;");
		}
		else
		{
			echo " <script> alert('old password Wrong') </script>";
		}
	}
	if(isset($_POST['detete_id']))
	{
		$uid=$_POST['uid'];
		mysql_query("delete from users where user_id=$uid;");
		header("location:../../index.php");
	}
	
?>
<?php
	$que_post_img=mysql_query("select * from user_post where user_id=$userid and post_pic!='' order by post_id desc");
	$photos_count=mysql_num_rows($que_post_img);
	$photos_count=$photos_count+$count1+1;
?>
<?php
		$user_data_query=mysql_query("select * from users where Email='$user'");
		$user_data=mysql_fetch_array($user_data_query);
		$bday=$user_data[5];
		$gender=$user_data[4];
		$Emial_id=$user_data[2];
		
		?>
<!DOCTYPE html>
<html lang="en"><head>
<!--Main CSS-->
<link href="../../Main_Template/css/profile.css?<?php echo time(); ?>" rel="stylesheet">
<link href="../../Main_Template/css/main.css?<?php echo time(); ?>" rel="stylesheet">
<!--BootStrap 4 Alpha config -->
<!-- BootStrap 4 alpha jquery config -->
<script src="../../Bootstrap_4/js/bootstrap.js?<?php echo time(); ?>"></script>
<script src="../../Bootstrap_4/js/bootstrap.min.js?<?php echo time(); ?>"></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../../Main_Template/js/tether.min.js?<?php echo time(); ?>" rel="stylesheet">
<link href="../../Bootstrap_4/css/bootstrap.min.css?<?php echo time(); ?>" rel="stylesheet">
</head>
<body id="body">
<!-- NavBar  Starts Here-->
<nav class="navbar container sticky-top navbar-light navbar-toggleable-md bg-faded justify-content-center">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
		<script>
		$(function () {
		$('[data-toggle="tooltip"]').tooltip()
			})
	</script>
			<a class="navbar-brand" href="#" data-toggle="tooltip" data-placement="bottom" title="By You & Manjot Sidhu">
			<img src="../../Main_Template/img/brand.png" width="30" height="30" class="d-inline-block align-top" alt="" > CandyGram</a>
			
    <div class="navbar-collapse collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto w-100 justify-content-center">
            <form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search">
				<button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>
			<!--<li class="nav-item active">
                <a class="nav-link" href="#">Link</a>
            </li>-->
        </ul>
        <ul class="nav mt-lg-0 justify-content-end nav nav-pills ">
			<li class="nav-item">
                <a class="nav-link" href="Home.php">Home</a>	
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../fb_profile/photos.php">Photos</a>
            </li>
			<li class="nav-item dropdown">
			<div class="btn-group">
  <button type="button" class="btn btn-success">Welcome, <?php echo $name; ?></button>
  <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="Home.php">NewsFeed</a>
    <a class="dropdown-item" href="../fb_profile/about.php">Profile Info</a>
    
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="Settings.php">Account Settings</a>
    <a class="dropdown-item" href="../fb_logout/logout.php">LogOut</a>
  </div>
</div>
      </li>
        </ul>
    </div>
</nav>
<!--NavBar Ends Here-->
<!--Here Starts The Main Body -->
    <div class="container" align="center">
    <!-- MainPanel Starts Here -->
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
				<div class="wrapper">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
								<header id="header">

				  <div class="slider">
				  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
					<div class="item active">
						<?php 
							$query3=mysql_query("select * from user_cover_pic where user_id=$userid");
							$rec3=mysql_fetch_array($query3);
							$cover_img=$rec3[2];
							
							$que_post_bg=mysql_query("select * from user_post where user_id=$userid");
							$count_bg=mysql_num_rows($que_post_bg);
							$count_bg=$count_bg+1;
						?>
					  <img src="<?php $filename="../../fb_users/".$gender."/".$user."/Cover/".$cover_img;
							if (getimagesize($filename)) {
								echo "$filename";
							} else {
								echo "img/cover.jpg";
							}
							?>" height="100%" width="100%">
					</div>
				  </div>
				</div>
                	</div><!--slider-->
                	<nav class="navbar navbar-default ">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header inline-block">
                          <a class="navbar-brands" href="#"><img class="img-responsive" src="
						  ../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Profile/<?php echo $img; ?>" style="height:100%; width:100%;"></a>
                          <span class="site-name"><b><?php echo $name; ?></b></span>                         
						  <span class="site-description"><?php echo $Emial_id; ?></span>
                        </div>
                    <ul class="nav nav-pills" style="margin-left:190px;margin-top:-25px">
							<li class="nav-item">
							<a class="nav-link" href="../fb_profile/about.php">About</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="../fb_profile/photos.php">Photos</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link active" href="Settings.php">Account Settings</a>
						  </li>
						</ul>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="mainNav" >
                          
                        </div><!-- /.navbar-collapse -->
					</nav>
                    
                </header><!--/#HEADER-->
		<ul class="nav nav-tabs justify-content-center" role="tablist">
				
			<li class="nav-item">
			<a class="nav-link active" href="#usr" role="tab" data-toggle="tab" aria-controls="usr" aria-expanded="true">Change Username</a>
			</li>

			<li class="nav-item">
			<a class="nav-link" href="#pass" role="tab" data-toggle="tab" aria-controls="pass">Change Password</a>
			</li>
			
			<li class="nav-item">
			<a class="nav-link" href="#del" role="tab" data-toggle="tab" aria-controls="del">Delete Account</a>
			</li>
			</ul>

			<!-- Content Panel -->
			<div class="tab-content">

			<div role="tabpanel" class="tab-pane fade show active" id="usr">
			<br><div class="display-4"> Change Username</div>
			<br>
			<form method="post"  name="name_change">
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">First Name : </label>
				<div class="">
				<input class="form-control" type="text" name="fnm" value="<?php echo $first_name; ?>" maxlength="15">
				</div>
			</div>
			<div class="form-group row justify-content-center">
			<label class="col-sm-2 col-form-label">Last Name : </label>
				<div><input class="form-control" type="text" name="lnm" value="<?php echo $last_name; ?>" maxlength="15"></div>
			</div>
			<hr>
			<input class="btn btn-warning" type="submit" value="Save" name="change_name">
			</form>
			</div>

			<div role="tabpanel" class="tab-pane fade" id="pass">
			<form method="post"  name="password_change">
			<br><div class="display-4"> Change Password</div>
			<br>
				<div class="form-group row justify-content-center">
					<label class="col-sm-2 col-form-label">Old Password</label>
					<div><input class="form-control" type="password" name="old_password" maxlength="30" ></div>
				</div>
				<div class="form-group row justify-content-center">
					<label class="col-sm-2 col-form-label">New Password</label>
					<div><input class="form-control" type="password" name="new_password" maxlength="30"></div>
				</div>
				<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Confirm Password</label>
				<div><input class="form-control" type="password" name="c_password" maxlength="30"></div>
				</div>
				<hr>
				<input class="btn btn-warning" type="submit" value="Change" name="change_password">
			</form>
			</div>

			<div role="tabpanel" class="tab-pane fade" id="del">
			<br><div class="display-4"> Delete Your Account Permanently</div>
			<br>
			<div class="card card-inverse card-danger text-center">
				<div class="card-block">
					<blockquote class="card-blockquote">
					<p>OK ... You want to delete your account . There should be a reason behind . Want to share it with me ? . Mail to me @manjot.gni@gmail.com .</p>
					<footer><small>By You & Manjot Sidhu</small></footer>
					</blockquote>
				</div>
			</div>
			<form method="post">
			<br><br>
			<input type="hidden" value="<?php echo $userid; ?>" name="uid">
			<input class="btn btn-danger" type="submit" value="Fck me & Delete My Account" name="detete_id" id="yes_button"> 
			<input class="btn btn-success" type="button" value="Wait I want to Fck U" id="no_button" onclick="location.href='Settings.php';"> 
			</form>
			</div>
			</div>
		</div>				
		<?php
	include("Settings_error/Settings_error.php");
		?>
  	<!-- MainPanel Ends Here -->
	</div>
 </body>
</html>
<?php
	}
	else
	{
		header("location:../../index.php");
	}
?>